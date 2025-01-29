<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Reservation extends Model
{
    protected $fillable = [
        'voyageur_id', 'societe_id', 'gare_depart', 'lieu_embarquement', 'destination',
        'date_depart', 'heure_depart', 'tarif_unitaire', 'nombre_tickets', 'total_paye',
        'paiement_mode', 'assurance', 'statut'
    ];

    public function voyageur()
    {
        return $this->belongsTo(User::class, 'voyageur_id');
    }

    public function societe()
    {
        return $this->belongsTo(SocieteTransport::class, 'societe_id');
    }
}
