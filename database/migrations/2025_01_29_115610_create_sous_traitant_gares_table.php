<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('sous_traitant_gares', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Sous-Traitant
            $table->unsignedBigInteger('gare_id'); // Gare
            $table->timestamps();

            // Clés étrangères
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('gare_id')->references('id')->on('gares')->onDelete('cascade');

            // Empêcher les doublons
            $table->unique(['user_id', 'gare_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('sous_traitant_gares');
    }
};

