<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request ->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login')->withSuccess('You have successfully logged out !');

    }

    public function store(loginRequest $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('users.index')->with('success', 'You are logged in.');
        }

        return back()->withErrors([
            'email' => 'Identifiants incorrects.',
        ])->onlyInput('email');
    }


}
