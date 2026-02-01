<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('nouveau_medecins', function (Blueprint $table) {
            $table->string('ville'); // Ajout de la colonne 'ville'
        });
    }
    
    public function down()
    {
        Schema::table('nouveau_medecins', function (Blueprint $table) {
            $table->dropColumn('ville'); // Supprimer la colonne 'ville' si la migration est inversée
        });
    }
    
};
