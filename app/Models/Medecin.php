<?php


namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Medecin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'medecin';
    public function rendezvous()
    {
        return $this->hasMany(Rendezvous::class);
    }
    protected $fillable = [
        'nom',
        'prenom',
        'specialite',
        'email',
        'password',
        'telephone',
        'ville',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
