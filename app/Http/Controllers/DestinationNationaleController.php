<?php

namespace App\Http\Controllers;

use App\Models\DestinationNationale;
use App\Models\SocieteTransport;
use App\Models\Lieu;
use App\Models\Gare;
use Carbon\Carbon;

use Illuminate\Http\Request;

class DestinationNationaleController extends Controller
{
    // Liste des destinations nationales
    public function index()
    {
        // Charger les destinations avec les informations de la société et des lieux de départ et d'arrivée
        $destinations = DestinationNationale::with(['societe', 'lieuDepart', 'lieuArrive'])->get();
    
        return view('destinations_national.index', compact('destinations'));
    }
   

    // Formulaire de création d'une destination nationale
    public function create()
    {
        $societes = SocieteTransport::all(); // Liste des sociétés
        $lieux = Lieu::all(); // Liste des lieux disponibles (départ et arrivée)

        return view('destinations_national.create', compact('societes', 'lieux'));
    }
    // Enregistrer une nouvelle destination nationale
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'societe_id' => 'required|exists:societes_transport,id',
            'gare_depart' => 'required|string|max:255',
            'depart' => 'required|string|max:255',
            'arrive' => 'required|string|max:255',
            'tarif_unitaire' => 'required|numeric|min:0',
            'premier_depart' => 'required|date_format:H:i',
            'dernier_depart' => 'required|date_format:H:i',
        ]);

        // Créer une nouvelle destination
        DestinationNationale::create($validated);

        return redirect()->route('destinations_national.index')->with('success', 'Destination créée avec succès.');
    }

    // Formulaire de modification d'une destination nationale
    public function edit($id)
    {
        $destination = DestinationNationale::findOrFail($id);
        $societes = SocieteTransport::all(); // Liste des sociétés
        $lieux = Lieu::all(); // Liste des lieux
  // Formater premier_depart et dernier_depart pour ne pas avoir les secondes
  $destination->premier_depart = Carbon::parse($destination->premier_depart)->format('H:i');
  $destination->dernier_depart = Carbon::parse($destination->dernier_depart)->format('H:i');

        return view('destinations_national.edit', compact('destination', 'societes', 'lieux'));
    }

    // Mettre à jour une destination nationale
    public function update(Request $request, $id)
    {
        // Récupérer la destination à mettre à jour
        $destination = DestinationNationale::findOrFail($id);

        // Validation des données
        $validated = $request->validate([
            'societe_id' => 'required|exists:societes_transport,id',
            'gare_depart' => 'required|string|max:255',
            'depart' => 'required|string|max:255',
            'arrive' => 'required|string|max:255',
            'tarif_unitaire' => 'required|numeric|min:0',
            'premier_depart' => 'required|date_format:H:i',
            'dernier_depart' => 'required|date_format:H:i',
        ]);

        // Mettre à jour les données
        $destination->update($validated);

        return redirect()->route('destinations_national.index')->with('success', 'Destination mise à jour avec succès.');
    }

    // Supprimer une destination nationale
    public function destroy($id)
    {
        // Récupérer et supprimer la destination
        $destination = DestinationNationale::findOrFail($id);
        $destination->delete();

        return redirect()->route('destinations_national.index')->with('success', 'Destination supprimée avec succès.');
    }

public function getGaresBySociete($societe_id)
{
    $gares = Gare::where('societe_id', $societe_id)->get();

    return response()->json($gares);
}
public function getLieuxByGare()
{

    // Vous pouvez ajuster la logique pour récupérer les lieux de départ et d’arrivée
    $lieux = [
        'depart' => Lieu::where('type', 'depart')->get(),
        'arrive' => Lieu::where('type', 'arrivee')->get()
    ];

    return response()->json($lieux);
}


}
