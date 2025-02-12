<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Paiement;
use Illuminate\Support\Facades\Validator;

class ApiReservationController extends Controller
{
    // 🔹 1. Créer une réservation
    public function createReservation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'voyageur_id' => 'required|exists:users,id',
            'societe_id' => 'required|exists:societes_transport,id',
            'gare_depart' => 'required|string',
            'lieu_embarquement' => 'required|string',
            'destination' => 'required|string',
            'date_depart' => 'required|date',
            'heure_depart' => 'required',
            'tarif_unitaire' => 'required|numeric',
            'nombre_tickets' => 'required|integer|min:1',
            'total_paye' => 'required|numeric',
            'paiement_mode' => 'required|string',
            'assurance' => 'nullable|boolean',
            'statut' => 'required|in:en attente,confirmée,annulée'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $reservation = Reservation::create($request->all());

        return response()->json([
            'message' => 'Réservation créée avec succès',
            'reservation' => $reservation
        ], 201);
    }

    // 🔹 2. Effectuer un paiement pour une réservation
    public function createPaiement(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reservation_id' => 'required|exists:reservations,id',
            'montant' => 'required|numeric|min:1',
            'mode_paiement' => 'required|string',
            'date_paiement' => 'required|date',
            'reference_transaction' => 'required|string|unique:paiements,reference_transaction',
            'statut' => 'required|in:en attente,Effectué,échoué'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $paiement = Paiement::create($request->all());

        return response()->json([
            'message' => 'Paiement effectué avec succès',
            'paiement' => $paiement
        ], 201);
    }
    // 🔹 3. Annuler ou confirmer une réservation
public function updateStatutReservation(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'statut' => 'required|in:confirmée,annulée'
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $reservation = Reservation::find($id);

    if (!$reservation) {
        return response()->json(['message' => 'Réservation non trouvée'], 404);
    }

    $reservation->update(['statut' => $request->statut]);

    return response()->json([
        'message' => 'Statut de la réservation mis à jour avec succès',
        'reservation' => $reservation
    ]);
}
public function getGaresBySousTraitant($user_id)
{
    $sousTraitant = User::find($user_id);

    if (!$sousTraitant) {
        return response()->json(['message' => 'Utilisateur non trouvé'], 404);
    }

    $gares = $sousTraitant->gares()->get();

    return response()->json([
        'message' => 'Gares récupérées avec succès',
        'gares' => $gares
    ]);
}

}
