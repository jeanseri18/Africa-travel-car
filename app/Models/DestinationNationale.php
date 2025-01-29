<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationNationale extends Model
{
    protected $table = 'destinations_nationales'; // Nom exact de la table dans la base de données

    protected $fillable = [
       'societe_id', 'gare_depart', 'depart','arrive', 'tarif_unitaire', 'premier_depart', 'dernier_depart'
    ];

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
