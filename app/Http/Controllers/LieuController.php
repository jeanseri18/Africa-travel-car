<?php

namespace App\Http\Controllers;

use App\Models\Lieu;
use Illuminate\Http\Request;

class LieuController extends Controller
{
    // Lister tous les lieux
    public function index()
    {
        $lieux = Lieu::all();
        return view('lieux.index', compact('lieux'));
    }

    // Formulaire pour créer un lieu
    public function create()
    {
        return view('lieux.create');
    }

    // Enregistrer un lieu
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ville' => 'required|string|max:255',
            'commune' => 'required|string|max:255',
            'type' => 'required|in:Arrivée,Départ',
        ]);

        Lieu::create($validated);

        return redirect()->route('lieux.index')->with('success', 'Lieu créé avec succès.');
    }

    // Formulaire pour modifier un lieu
    public function edit($id)
    {
        $lieu = Lieu::findOrFail($id);
        return view('lieux.edit', compact('lieu'));
    }

    // Mettre à jour un lieu
    public function update(Request $request, $id)
    {
        $lieu = Lieu::findOrFail($id);

        $validated = $request->validate([
            'ville' => 'required|string|max:255',
            'commune' => 'required|string|max:255',
            'type' => 'required|in:Arrivée,Départ',
        ]);

        $lieu->update($validated);

        return redirect()->route('lieux.index')->with('success', 'Lieu mis à jour avec succès.');
    }

    // Supprimer un lieu
    public function destroy($id)
    {
        $lieu = Lieu::findOrFail($id);
        $lieu->delete();

        return redirect()->route('lieux.index')->with('success', 'Lieu supprimé avec succès.');
    }
}
