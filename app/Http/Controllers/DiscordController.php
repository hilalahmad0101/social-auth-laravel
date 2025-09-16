<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class DiscordController extends Controller
{
    public function redirectToDiscord()
    {
        return Socialite::driver('discord')->redirect();
    }

    /**
     * Handle Discord OAuth callback
     */
    public function handleDiscordCallback()
    {
        try {
            $discordUser = Socialite::driver('discord')->user();

            // Check if user exists with this Discord ID
            $user = User::where('provider_id', $discordUser->getId())->first();

            if ($user) {
                // User exists, update their info and login
                $user->update([
                    'name' => $discordUser->getName(),
                    'avatar' => $discordUser->getAvatar(),
                ]);

                Auth::login($user);
                return redirect()->intended('dashboard');
            }

            // Check if user exists with same email
            $existingUser = User::where('email', $discordUser->getEmail())->first();

            if ($existingUser) {
                // Link Discord account to existing user
                $existingUser->update([
                    'provider_id' => $discordUser->getId(),
                    'avatar' => $discordUser->getAvatar(),
                ]);

                Auth::login($existingUser);
                return redirect()->intended('dashboard');
            }

            // Create new user
            $newUser = User::create([
                'name' => $discordUser->getName(),
                'email' => $discordUser->getEmail(),
                'provider_id' => $discordUser->getId(),
                'provider' => 'discord', // Set the provider to 'discord'
                'avatar' => $discordUser->getAvatar(),
                'email_verified_at' => now(), // Discord emails are verified
            ]);

            Auth::login($newUser);
            return redirect()->intended('dashboard');
        } catch (Exception $e) {
            return redirect('/')->with('error', 'Something went wrong with Discord authentication.');
        }
    }
}
