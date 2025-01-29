<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationSousRegionale extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'destinations_sous_regionales';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'societe_id',
        'gare_depart',
        'destination',
        'tarif_unitaire',
        'premier_depart',
        'dernier_depart',
    ];

    /**
     * Relation: Une destination appartient à une société de transport.
     */

     public function societe()
     {
         return $this->belongsTo(SocieteTransport::class);
     }
     public function gare()
     {
         return $this->belongsTo(Gare::class,'gare_depart');
     }
     // Dans DestinationNationale.php
 public function lieuDepart()
 {
     return $this->belongsTo(Lieu::class, 'depart');
 }
 
 public function lieuArrive()
 {
     return $this->belongsTo(Lieu::class, 'arrive');
 }
}
