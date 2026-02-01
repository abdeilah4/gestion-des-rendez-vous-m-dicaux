<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Disponibilite.php

class Disponibilite extends Model
{
    protected $fillable = ['medecin_id', 'jour', 'heure', 'statut'];

    public function medecin()
    {
        return $this->belongsTo(Medecin::class);
    }
}