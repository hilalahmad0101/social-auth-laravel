<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $findUser = User::where('provider_id', $user->id)->first();

            if ($findUser) {
                Auth::login($findUser);
                return redirect()->intended('dashboard');
            }

            // create new user
            $newUser = User::create([
                'name' => $user->name,
                'provider_id' => $user->id,
                'email' => $user->email,
                'provider' => 'facebook',
                'password' => encrypt('123456dummy'),
                'avatar' => $user->avatar,
            ]);

            Auth::login($newUser);
            return redirect()->intended('dashboard');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
