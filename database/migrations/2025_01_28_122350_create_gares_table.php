<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gares', function (Blueprint $table) {
            $table->id(); // id SERIAL PRIMARY KEY
            $table->unsignedBigInteger('societe_id'); // societe_id INT NOT NULL
            $table->string('nom_gare', 255); // nom_gare VARCHAR(255) NOT NULL
            $table->decimal('latitude', 10, 8)->nullable(); // latitude DECIMAL(10, 8) NULL
            $table->decimal('longitude', 11, 8)->nullable(); // longitude DECIMAL(11, 8) NULL
            $table->enum('type_gare', ['Départ', 'Arrivée', 'Mixte']); // type_gare ENUM(...)
            $table->enum('type_destination', ['nation', 'sous region', ]); // type_gare ENUM(...)
            $table->string('ville', 255); // nom_gare VARCHAR(255) NOT NULL
            $table->string('commune', 255); // nom_gare VARCHAR(255) NOT NULL
            $table->string('quartier', 255); // nom_gare VARCHAR(255) NOT NULL

            $table->string('contact', 100)->nullable(); // contact VARCHAR(100) NULL
            $table->json('horaires_ouverture'); // horaires_ouverture JSON NOT NULL
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
        Schema::dropIfExists('gares');
    }
}
