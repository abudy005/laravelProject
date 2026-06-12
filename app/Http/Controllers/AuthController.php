<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show the login form — GET /login
    public function loginForm()
    {
        return view('login');
    }

    // Process the login form — POST /login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        // Auth::attempt hashes the password and checks it against the users table.
        // Second arg = "remember me" (sets a long-lived cookie).
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Prevent session fixation by issuing a fresh session ID
            $request->session()->regenerate();

            // intended() sends them to the page they were trying to reach
            // before being bounced to login, or home as a fallback.
            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->onlyInput('email');
    }

    // Log the user out — POST /logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
