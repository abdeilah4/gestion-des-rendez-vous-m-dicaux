<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rendezvouses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('medecin_id')->constrained()->onDelete('cascade');
            $table->foreignId('disponibilite_id')->constrained()->onDelete('cascade');
            $table->date('jour'); // Modifier ici, on utilise le type "date" pour stocker la date réelle
            $table->time('heure'); // Heure du rendez-vous
            $table->enum('statut', ['en attente', 'confirmé', 'annulé'])->default('en attente');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rendezvouses');
    }
};
