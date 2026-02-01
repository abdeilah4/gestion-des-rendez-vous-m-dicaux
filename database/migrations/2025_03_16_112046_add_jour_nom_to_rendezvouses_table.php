<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJourNomToRendezvousesTable extends Migration
{
    public function up()
    {
        Schema::table('rendezvouses', function (Blueprint $table) {
            $table->string('jour_nom')->nullable();  // Ajouter la colonne 'jour_nom' pour stocker le nom du jour.
        });
    }

    public function down()
    {
        Schema::table('rendezvouses', function (Blueprint $table) {
            $table->dropColumn('jour_nom');  // Supprimer la colonne 'jour_nom' si on revient en arrière.
        });
    }
}
