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
        Schema::create('societes_transport', function (Blueprint $table) {
            $table->id();
            $table->string('nom_commercial');
            $table->date('date_creation');
            $table->string('siege_social');
            $table->string('responsable_marketing');
            $table->string('contact_telephone');
            $table->string('whatsapp');
            $table->string('email');
            $table->integer('nombre_gares');
            $table->json('sites_gares')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('societes_transport');
    }
};
