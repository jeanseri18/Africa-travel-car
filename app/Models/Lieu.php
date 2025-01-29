<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lieu extends Model
{
    use HasFactory;

    /**
     * Le nom de la table associée.
     *
     * @var string
     */
    protected $table = 'lieux';

    /**
     * Les attributs pouvant être remplis via un formulaire ou un tableau.
     *
     * @var array
     */
    protected $fillable = [
        'ville',
        'commune',
        'type', // 'Arrivée' ou 'Départ'
    ];
}
