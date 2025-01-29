<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousTraitant extends Model
{
    protected $fillable = [
        'utilisateur_id', 'type_entreprise', 'date_naissance', 'commune_exercice',
        'forme_juridique', 'capital', 'rccm', 'compte_contribuable', 'ligne_destination'
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }
}
