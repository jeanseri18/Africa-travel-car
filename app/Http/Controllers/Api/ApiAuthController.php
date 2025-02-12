<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class ApiAuthController extends Controller
{
      // Connexion de l'administrateur
      public function login(Request $request)
      {
          $request->validate([
              'email' => 'required|email',
              'password' => 'required',
          ]);
  
          if (Auth::attempt($request->only('email', 'password'))) {
              $user = Auth::user();
              if ($user->type === 'Voyageur') {
                  $token = $user->createToken('admin-token')->plainTextToken;
                  return response()->json(['token' => $token, 'user' => $user], 200);
              } else {
                  return response()->json(['error' => 'Accès refusé.'], 403);
              }
          }
  
          return response()->json(['error' => 'Identifiants incorrects.'], 401);
      }
  
      // Inscription d'un administrateur
      public function register(Request $request)
      {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'contact_telephone' => 'required|string|max:20', // Ajout de la validation
        ]);
        
  
          $user = User::create([
              'nom' => $request->nom,
              'prenom' => $request->prenom,
              'email' => $request->email,
              'contact_telephone' => $request->contact_telephone,
              'password' => Hash::make($request->password),
              'type' => 'Voyageur',
          ]);
  
          return response()->json(['message' => 'Administrateur créé avec succès.', 'user' => $user], 201);
      }
  
      // Déconnexion de l'administrateur
      public function logout(Request $request)
      {
          $request->user()->tokens()->delete();
          return response()->json(['message' => 'Déconnexion réussie.'], 200);
      }
}
