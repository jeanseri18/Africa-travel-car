<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gare extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gares';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'societe_id',
        'nom_gare',
        'latitude',
        'longitude',
        'type_gare',
        'type_destination',
        'ville',
        'commune',
        'quartier',
        'contact',
        'horaires_ouverture',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'horaires_ouverture' => 'array',
    ];

    /**
     * Relation: Gare appartient à une société de transport.
     */
    public function societe()
    {
        return $this->belongsTo(SocieteTransport::class, 'societe_id');
    }
    public function sousTraitants()
    {
        return $this->belongsToMany(User::class, 'sous_traitant_gares');
    }
}

