<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Importer la classe User
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NouveauMedecin extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nom', 'prenom', 'specialite', 'email', 'numCertificat', 'telephone', 'ville', 'password',
    ];

    // Masquer le mot de passe lors de la récupération des données
    protected $hidden = ['password'];

    // Optionnel : pour définir une table différente (si nécessaire)
    // protected $table = 'nouveau_medecins';
}
