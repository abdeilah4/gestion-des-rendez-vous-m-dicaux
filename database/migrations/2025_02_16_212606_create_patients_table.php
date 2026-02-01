<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Fichier de migration patients_table
Schema::create('patients', function (Blueprint $table) {
  
        $table->id();
        $table->string('nom');
        $table->string('prenom');
        $table->string('email')->unique();
        $table->date('date_naissance');
        $table->string('adresse');
        $table->enum('genre', ['Masculin', 'Féminin']);
        $table->string('password');
        $table->timestamps();
    });
  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
};
