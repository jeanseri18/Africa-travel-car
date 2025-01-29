<?php

namespace App\Http\Controllers;

use App\Models\SocieteTransport;
use App\Models\Gare;
use Illuminate\Http\Request;

class SocieteController extends Controller
{
    // Liste des sociétés de transport
    public function index()
    {
        $societes = SocieteTransport::all();
        return view('societes.index', compact('societes'));
    }

    // Créer une nouvelle société de transport
    public function create()
    {
        return view('societes.create');
    }

    // Sauvegarder une nouvelle société de transport
    public function store(Request $request)
    {
        $request->validate([
            'nom_commercial' => 'required',
            'date_creation' => 'required|date',
            'siege_social' => 'required',
            'responsable_marketing' => 'required',
            'contact_telephone' => 'required',
            'whatsapp' => 'required',
            'email' => 'required|email',
            'nombre_gares' => 'required|integer',
        ]);

        SocieteTransport::create($request->all());

        return redirect()->route('societes.index')->with('success', 'Société créée avec succès.');
    }

    // Modifier une société de transport
    public function edit($id)
    {
        $societe = SocieteTransport::findOrFail($id);
        return view('societes.edit', compact('societe'));
    }

    // Sauvegarder les modifications de la société
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom_commercial' => 'required',
            'date_creation' => 'required|date',
            'siege_social' => 'required',
            'responsable_marketing' => 'required',
            'contact_telephone' => 'required',
            'whatsapp' => 'required',
            'email' => 'required|email',
            'nombre_gares' => 'required|integer',
        ]);

        $societe = SocieteTransport::findOrFail($id);
        $societe->update($request->all());

        return redirect()->route('societes.index')->with('success', 'Société mise à jour avec succès.');
    }

    // Supprimer une société de transport
    public function destroy($id)
    {
        $societe = SocieteTransport::findOrFail($id);
        $societe->delete();

        return redirect()->route('societes.index')->with('success', 'Société supprimée avec succès.');
    }

    // Afficher les gares d'une société
    public function showGares($societe_id)
    {
        $gares = Gare::where('societe_id', $societe_id)->get();
        return view('societes.gares', compact('gares', 'societe_id'));
    }
    public function showAllGares()
    {
        $gares = Gare::all();
        return view('gares.index', compact('gares'));
    }

    // Ajouter une gare pour une société
    public function createGare($societe_id)
    {
        return view('gares.create', compact('societe_id'));
    }

// Sauvegarder une gare
public function storeGare(Request $request, $societe_id)
{
    $validated = $request->validate([
        'nom_gare' => 'required|string|max:255',
        'type_gare' => 'required|in:Départ,Arrivée,Mixte',
        'type_destination' => 'required|in:nation,sous region',
        'ville' => 'required|string|max:255',
        'commune' => 'required|string|max:255',
        'quartier' => 'required|string|max:255',
        'latitude' => 'nullable|numeric|between:-90,90',
        'longitude' => 'nullable|numeric|between:-180,180',
        'horaires_ouverture' => 'nullable|array',
        'horaires_ouverture.*.start' => 'nullable|date_format:H:i',
        'horaires_ouverture.*.end' => 'nullable|date_format:H:i',
        'contact' => 'nullable|string|max:100',
    ]);

    $horaires = [];
    if (!empty($validated['horaires_ouverture'])) {
        foreach ($validated['horaires_ouverture'] as $day => $times) {
            $horaires[$day] = [
                'start' => $times['start'] ?? null,
                'end' => $times['end'] ?? null,
            ];
        }
    }

    Gare::create([
        'societe_id' => $societe_id,
        'nom_gare' => $validated['nom_gare'],
        'type_gare' => $validated['type_gare'],
        'type_destination' => $validated['type_destination'],
        'ville' => $validated['ville'],
        'commune' => $validated['commune'],
        'quartier' => $validated['quartier'],
        'latitude' => $validated['latitude'],
        'longitude' => $validated['longitude'],
        'horaires_ouverture' => json_encode($horaires),
        'contact' => $validated['contact'],
    ]);

    return redirect()->route('societes.gares', $societe_id)->with('success', 'Gare ajoutée avec succès.');
}
public function editGare($gare_id)
{


    // Récupérer la gare par ID
    $gare = Gare::findOrFail($gare_id);
    // Récupérer la société associée à cette gare
    $societe = $gare->societe;  // Utilisation de la relation définie dans le modèle Gare
    $gare->horaires_ouverture = json_decode($gare->horaires_ouverture, true);
    // Passer les données à la vue
    return view('gares.edit', compact('societe', 'gare'));
}




public function updateGare(Request $request, $societe_id, $gare_id)
{
    $validated = $request->validate([
        'nom_gare' => 'required|string|max:255',
        'type_gare' => 'required|in:Départ,Arrivée,Mixte',
        'latitude' => 'nullable|numeric|between:-90,90',
        'longitude' => 'nullable|numeric|between:-180,180',
        'contact' => 'nullable|string|max:100',
        'horaires_ouverture' => 'nullable|array',
        'horaires_ouverture.*.start' => 'nullable|date_format:H:i',
        'horaires_ouverture.*.end' => 'nullable|date_format:H:i',
    ]);

    // Préparer les horaires d'ouverture sous forme de tableau
    $horaires = [];
    if (!empty($validated['horaires_ouverture'])) {
        foreach ($validated['horaires_ouverture'] as $day => $times) {
            $horaires[$day] = [
                'start' => $times['start'] ?? null,
                'end' => $times['end'] ?? null,
            ];
        }
    }

    $gare = Gare::findOrFail($gare_id);
    $gare->update([
        'nom_gare' => $validated['nom_gare'],
        'type_gare' => $validated['type_gare'],
        'latitude' => $validated['latitude'],
        'longitude' => $validated['longitude'],
        'contact' => $validated['contact'],
        'horaires_ouverture' => json_encode($horaires),
    ]);

    return redirect()->route('societes.gares', $societe_id)->with('success', 'Gare mise à jour avec succès.');
}

public function deleteGare($societe_id, $gare_id)
{
    // Trouver la gare et la supprimer
    $gare = Gare::findOrFail($gare_id);
    $gare->delete();

    return redirect()->route('societes.show', $societe_id)->with('success', 'Gare supprimée avec succès.');
}

}
