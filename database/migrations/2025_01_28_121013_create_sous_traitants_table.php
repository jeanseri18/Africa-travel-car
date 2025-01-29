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
        Schema::create('sous_traitants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('users');
            $table->enum('type_entreprise', ['Personne Physique', 'Personne Morale']);
            $table->date('date_naissance')->nullable();
            $table->string('commune_exercice')->nullable();
            $table->string('forme_juridique')->nullable();
            $table->decimal('capital', 15, 2)->nullable();
            $table->string('rccm')->nullable();
            $table->string('compte_contribuable')->nullable();
            $table->json('ligne_destination')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sous_traitants');
    }
};
