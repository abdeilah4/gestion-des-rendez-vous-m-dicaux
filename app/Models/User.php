<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    public function rendezvous()
    {
        return $this->hasMany(RendezVous::class);
    }
    protected $fillable = [
        'name',
        'email',
        'password',
        'date_naissance',
        'prenom', // Ajout du champ prenom
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_naissance' => 'date', // Assure que date_naissance est traité comme une date
    ];
}
