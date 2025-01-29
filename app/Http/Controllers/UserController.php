<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Afficher la liste des utilisateurs (Admin & Sous-Traitant).
     */
    public function index()
    {
        $users = User::whereIn('type', ['Administrateur', 'Sous-Traitant'])->get();
        return view('users.index', compact('users'));
    }

    /**
     * Afficher le formulaire de création d'un utilisateur.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Enregistrer un nouvel utilisateur.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users',
            'contact_telephone' => 'required|string|max:15',
            'whatsapp' => 'nullable|string|max:15',
            'password' => 'required|string|min:6|confirmed',
            'type' => 'required|in:Administrateur,Sous-Traitant',
        ]);

        User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'contact_telephone' => $request->contact_telephone,
            'whatsapp' => $request->whatsapp,
            'password' => Hash::make($request->password),
            'type' => $request->type,
        ]);

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Afficher le formulaire d'édition d'un utilisateur.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Mettre à jour un utilisateur.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'contact_telephone' => 'required|string|max:15',
            'whatsapp' => 'nullable|string|max:15',
            'type' => 'required|in:Administrateur,Sous-Traitant',
        ]);

        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour.');
    }

    /**
     * Supprimer un utilisateur.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé.');
    }
}
