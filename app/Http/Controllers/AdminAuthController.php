<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Assurez-vous que le modèle User est importé
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    // Afficher le formulaire de login
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // Traitement du login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Vérification des informations d'authentification
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            if ($user->type === 'Administrateur') {
                return redirect()->route('dashboard.index');
            } else {
                Auth::logout();
                return redirect()->route('admin.login')->withErrors(['error' => 'Vous n\'êtes pas un administrateur.']);
            }
        }

        return back()->withErrors(['error' => 'Email ou mot de passe incorrect.']);
    }

    // Afficher le formulaire de registre
    public function showRegisterForm()
    {
        return view('admin.auth.register');
    }

    // Traitement de l'enregistrement
    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'contact_telephone' => $request->contact_telephone,
            'password' => Hash::make($request->password),
            'type' => 'Administrateur',
        ]);

        return redirect()->route('admin.login')->with('success', 'Compte administrateur créé avec succès.');
    }

    // Déconnexion
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
