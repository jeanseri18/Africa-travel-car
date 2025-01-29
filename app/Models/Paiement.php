<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = [
        'reservation_id', 'montant', 'mode_paiement', 'date_paiement', 'reference_transaction', 'statut'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
