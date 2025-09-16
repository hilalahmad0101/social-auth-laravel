<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function deleteAccount(Request $request)
    {
        $request->validate([
            'confirmation' => 'required|in:DELETE',
        ], [
            'confirmation.in' => 'You must type "DELETE" to confirm account deletion.'
        ]);

        try {
            $user = Auth::user();

            // Log the user out before deleting
            Auth::logout();

            // Invalidate session
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Delete the user account
            $user->delete();

            return redirect('/')->with('success', 'Your account has been successfully deleted.');
        } catch (\Exception $e) {
            return back()->with('error', 'There was an error deleting your account. Please try again.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out successfully.');
    }
}
