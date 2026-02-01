<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('disponibilites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medecin_id')->constrained()->onDelete('cascade');
            $table->string('jour'); // Store the day name (e.g., "Lundi")
            $table->time('heure'); // Store the time in "H:i" format
            $table->enum('statut', ['disponible', 'réservé'])->default('disponible');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('disponibilites');
    }
};
