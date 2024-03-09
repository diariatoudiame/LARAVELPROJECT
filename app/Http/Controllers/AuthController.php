<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    function register(Request $request)
    {

        // Valider les données d'entrée
        $data = $request->validate([
            'name' => 'required|string',
            'firstname' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id',
        ]);

        if ($request->hasFile('photo')) {
            $photoName = time().'.'.$request->photo->extension();
            $photoPath = $request->file('photo')->storeAs('photos', $photoName, 'public');
            $data['photo'] = $photoPath;
        }


        $user = new User();
        $user->name = $data['name'];
        $user->firstname = $data['firstname'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->photo = $data['photo'];

        $user->save();
        $user->roles()->attach($data['role_id']);

        Auth::login($user);
        return redirect()->route('dashboard')
                        ->with('success', 'User registered successfully and logged in.');
    }


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

            // Vérifier le rôle de l'utilisateur
            if (Auth::check()) {
                return redirect()->route('dashboard')->with('success', 'You are logged in as admin.');
            }
        }

        return back()->withErrors([
            'email' => 'Identifiants incorrects.',
        ])->onlyInput('email');
    }


}
