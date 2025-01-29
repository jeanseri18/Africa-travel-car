<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    // Afficher la liste des paiements
    public function index()
    {
        // Récupérer tous les paiements
        $paiements = Paiement::with('reservation')->get();

        // Retourner la vue avec les paiements
        return view('paiements.index', compact('paiements'));
    }
}

