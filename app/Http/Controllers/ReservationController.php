<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // Afficher la liste des réservations
    public function index()
    {
        // Récupère toutes les réservations avec leurs relations
        $reservations = Reservation::with(['voyageur', 'societe'])->get();

        return view('reservations.index', compact('reservations'));
    }
}
