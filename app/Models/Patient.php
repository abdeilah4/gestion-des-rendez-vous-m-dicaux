<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
class Patient extends Authenticatable
{
    use HasFactory, Notifiable;
     protected $guard = 'patient';
    protected $table = 'patients';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'date_naissance',
        'adresse',
        'genre',
        'password', // ✅ Assure-toi que ce champ est bien là
    ];
    

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected static function booted()
    {
        static::creating(function ($patient) {
            $patient->password = Hash::make($patient->password);
        });
    }
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    

    // ✅ Mutator pour hasher le mot de passe avant de le stocker
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

}