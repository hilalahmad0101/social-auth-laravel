<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback()
    {
        try {
            $githubUser = Socialite::driver('github')->user();
            $findUser = User::where('provider_id', $githubUser->id)->first();
            if ($findUser) {
                Auth::login($findUser);
                return redirect('/dashboard');
            }

            $user = User::create([
                'provider_id' => $githubUser->getId(),
                'name' => $githubUser->getName() ?? $githubUser->getNickname(),
            ]);

            Auth::login($user);

            return redirect('/dashboard');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
