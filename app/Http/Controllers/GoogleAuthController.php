<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {

        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('provider_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                return redirect()->intended('dashboard');
            }

            $newUser = User::create([
                'name' => $user?->name,
                'email' => $user?->email,
                'provider_id' => $user?->id,
                'provider' => 'google',
                // 'avatar' => $user?->avatar,
                'password' => encrypt('123456dummy')

            ]);

            Auth::login($newUser);
            return redirect()->intended('dashboard');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
