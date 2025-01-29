<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinationsSousRegionalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinations_sous_regionales', function (Blueprint $table) {
            $table->id(); // id PRIMARY KEY
            $table->unsignedBigInteger('societe_id'); // societe_id (FK vers Sociétés de Transport)
            $table->string('gare_depart', 255); // Gare de départ
            $table->string('depart', 255); // Destination
            $table->string('arrive', 255); // Destination
            $table->decimal('tarif_unitaire', 10, 2); // Tarif unitaire (DECIMAL)
            $table->time('premier_depart'); // Heure du premier départ
            $table->time('dernier_depart'); // Heure du dernier départ
            $table->timestamps(); // created_at, updated_at

            // Foreign key
            $table->foreign('societe_id')
                  ->references('id')
                  ->on('societes_transport')
                  ->onDelete('cascade'); // ON DELETE CASCADE
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('destinations_sous_regionales');
    }
}
