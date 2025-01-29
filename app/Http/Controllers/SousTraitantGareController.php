<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Gare;
use Illuminate\Http\Request;

class SousTraitantGareController extends Controller
{
    /**
     * Affiche les gares d’un sous-traitant
     */
    public function index($id)
    {
        // Récupérer le sous-traitant avec ses gares associées
        $sousTraitant = User::with('gares')->findOrFail($id);

        // Récupérer toutes les gares disponibles à attribuer
        $gares = Gare::all();

        // Passer les gares et le sous-traitant à la vue
        return view('sous_traitant_gares.index', compact('sousTraitant', 'gares'));
    }

    /**
     * Attribuer des gares à un sous-traitant
     */
    public function store(Request $request)
    {
        $request->validate([
            'sous_traitants' => 'required|array',
            'gares' => 'required|array'
        ]);

        foreach ($request->sous_traitants as $sousTraitantId) {
            $sousTraitant = User::find($sousTraitantId);
            $sousTraitant->gares()->syncWithoutDetaching($request->gares);
        }

        return redirect()->back()->with('success', 'Gares attribuées avec succès.');
    }

    /**
     * Supprimer une gare attribuée à un sous-traitant
     */
    public function destroy($userId, $gareId)
    {
        $sousTraitant = User::findOrFail($userId);
        $sousTraitant->gares()->detach($gareId);
        return redirect()->route('sous_traitant_gares.index', $userId)->with('success', 'Gare retirée.');
    }
}
