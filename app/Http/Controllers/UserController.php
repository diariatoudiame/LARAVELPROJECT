<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $roles = Role::all();
       return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'firstname' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id',
        ]);

        // Vérifie si une photo est téléchargée
        if ($request->hasFile('photo')) {
            $photoName = time().'.'.$request->photo->extension();
            $photoPath = $request->file('photo')->storeAs('photos', $photoName, 'public');
            $data['photo'] = $photoPath;
        }

        // Crée un nouvel utilisateur avec les données validées
        $user = User::create([
            'name' => $request->input('name'),
            'firstname' => $request->input('firstname'),
            'email' => $request->input('email'),
            'photo' => $data['photo'],
            'password' => $request->input('password'),

        ]);

        // Associe le rôle à l'utilisateur
        $role = Role::find($data['role_id']);
        $user->roles()->attach($role->id);

        // Redirige vers une route appropriée
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('students.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', ['user' => $user],compact('roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'firstname' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:6',
            'role_id' => 'required|exists:roles,id',
        ]);

        // Récupère l'utilisateur à mettre à jour
        $user = User::findOrFail($id);

        // Met à jour les données de l'utilisateur
        $user->name = $data['name'];
        $user->firstname = $data['firstname'];
        $user->email = $data['email'];

        // Vérifie si un nouveau mot de passe est fourni
        if ($request->filled('password')) {
            $user->password = bcrypt($data['password']);
        }

        // Vérifie si une nouvelle photo est téléchargée
        if ($request->hasFile('photo')) {
            // Supprime l'ancienne photo si elle existe
            Storage::disk('public')->delete($user->photo);

            // Télécharge et enregistre la nouvelle photo
            $photoName = time().'.'.$request->photo->extension();
            $photoPath = $request->file('photo')->storeAs('photos', $photoName, 'public');
            $user->photo = $photoPath;
        }


        $user->save();


        $role = Role::find($data['role_id']);
        $user->roles()->sync([$role->id]);


        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {

        Storage::disk('public')->delete($user->photo);
        $user->delete();
        $user->roles()->detach();

        return redirect()->route('users.index');
    }
}
