<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class RendezVous extends Model
{
    use HasFactory;

    // Nom de la table dans la base de données
    protected $table = 'rendezvouses';

    // Colonnes que vous pouvez remplir en masse
    protected $fillable = [
        'medecin_id',
        'patient_id',
        'disponibilite_id',
        'date',
        'heure',
        'statut'
    ];

    // Définir les relations (si nécessaire)
    public function medecin()
    {
        return $this->belongsTo(Medecin::class);
    }
    
    public function patient()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function disponibilite()
    {
        return $this->belongsTo(Disponibilite::class);
    }
}
