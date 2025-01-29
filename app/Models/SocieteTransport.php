<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SocieteTransport extends Model
{
    protected $table = 'societes_transport'; // Nom exact de la table dans la base de données

    protected $fillable = [
        'nom_commercial', 'date_creation', 'siege_social', 'responsable_marketing',
        'contact_telephone', 'whatsapp', 'email', 'nombre_gares', 'sites_gares'
    ];
}

?>