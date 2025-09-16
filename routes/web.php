<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscordController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\LinkedInController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialAuthController;



Route::middleware(['guest'])->group(function () {
    Route::get('/',  function () {
        return view('button');
    });
    Route::get('auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);


    Route::controller(FacebookController::class)->group(function () {
        Route::get('auth/facebook', 'redirectToFacebook')->name('auth.facebook');
        Route::get('auth/facebook/callback', 'handleFacebookCallback');
    });

    Route::controller(GithubController::class)->group(function () {
        Route::get('auth/github', 'redirectToGithub')->name('auth.github');
        Route::get('auth/github/callback', 'handleGithubCallback');
    });

    Route::controller(LinkedInController::class)->group(function () {
        Route::get('auth/linkedin', 'redirectToLinkedin')->name('auth.linkedin');
        Route::get('auth/linkedin/callback', 'handleLinkedinCallback');
    });

    Route::controller(DiscordController::class)->group(function () {
        Route::get('auth/discord', 'redirectToDiscord')->name('auth.discord');
        Route::get('auth/discord/callback', 'handleDiscordCallback');
    });
});



Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view(view: 'dashboard');
    });

    Route::delete('/account/delete', [DashboardController::class, 'deleteAccount'])->name('account.delete');
    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');
});
