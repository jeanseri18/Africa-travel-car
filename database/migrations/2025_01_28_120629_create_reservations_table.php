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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voyageur_id')->constrained('users')->where('type', 'Voyageur');
            $table->foreignId('societe_id')->constrained('societes_transport');
            $table->string('gare_depart');
            $table->string('lieu_embarquement');
            $table->string('destination');
            $table->date('date_depart');
            $table->time('heure_depart');
            $table->decimal('tarif_unitaire', 8, 2);
            $table->integer('nombre_tickets');
            $table->decimal('total_paye', 8, 2);
            $table->string('paiement_mode');
            $table->string('assurance');
            $table->enum('statut', ['En attente', 'Confirmée', 'Annulée']);
            $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
