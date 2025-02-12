<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lieu;
use App\Models\Gare;
use App\Models\SocieteTransport;
use App\Models\DestinationNationale;
use Illuminate\Http\Request;

class ApiTransportController extends Controller
{
    // 🔹 Afficher tous les lieux
    public function getLieux()
    {
        $lieux = Lieu::all();
        return response()->json($lieux);
    }

    // 🔹 Afficher toutes les sociétés de transport
    public function getSocietesTransport()
    {
        $societes = SocieteTransport::all();
        return response()->json($societes);
    }

    // 🔹 Afficher les destinations d'une société de transport en fonction du type, de l'arrivée et du départ
    public function getDestinations(Request $request)
    {
        $request->validate([
            'societe_id' => 'required|exists:societes_transport,id',
            'gare_depart' => 'required|exists:societes_transport,id',
            'type' => 'nullable|string',
            'depart' => 'nullable|string',
            'arrive' => 'nullable|string',
        ]);

        $query = DestinationNationale::where('societe_id', $request->societe_id);

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        if ($request->has('depart')) {
            $query->where('depart', $request->depart);
        }
        if ($request->has('gare_depart')) {
            $query->where('gare_depart', $request->gare_depart);
        }

        if ($request->has('arrive')) {
            $query->where('arrive', $request->arrive);
        }

        $destinations = $query->with(['lieuDepart', 'lieuArrive'])->get();

        return response()->json($destinations);
    }
    public function getGaresByTypeDestination(Request $request)
    {
        $request->validate([
            'societe_id' => 'required|exists:societes_transport,id',
            'type_destination' => 'required|string|in:nation,sous region',
        ]);

        $gares = Gare::where('societe_id', $request->societe_id)
            ->where('type_destination', $request->type_destination)
            ->get();

        return response()->json($gares);
    }
}
