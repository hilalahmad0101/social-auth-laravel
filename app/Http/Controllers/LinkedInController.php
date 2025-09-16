<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LinkedInController extends Controller
{
    public function redirectToLinkedin()
    {
        return Socialite::driver('linkedin')->redirect();
    }



    public function handleLinkedinCallback()
    {
        try {

            $user = Socialite::driver('linkedin')->user();
            $findUser = User::where('provider_id', $user->id)->first();
            if ($findUser) {
                Auth::login($findUser);
                return redirect()->intended('dashboard');
            }
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'provider' => 'linkedin',
                'provider_id' => $user->id,

            ]);
            Auth::login($newUser);

            return redirect()->intended('dashboard');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
