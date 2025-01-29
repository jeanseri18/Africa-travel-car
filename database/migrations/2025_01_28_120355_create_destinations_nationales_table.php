<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('destinations_nationales', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->foreignId('societe_id')->constrained('societes_transport');
            $table->string('gare_depart');
            $table->string('depart');
            $table->string('arrivé');

            $table->decimal('tarif_unitaire', 8, 2);
            $table->time('premier_depart');
            $table->time('dernier_depart');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations_nationales');
    }
};
