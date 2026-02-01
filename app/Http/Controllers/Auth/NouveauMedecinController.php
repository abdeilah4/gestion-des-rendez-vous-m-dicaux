<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\NouveauMedecin;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class NouveauMedecinController extends Controller
{
    /**
     * Affiche le formulaire d'inscription.
     */
    public function create()
    {
        return view('auth.register-nouveau-medecin');
    }
    public function confirmation(Request $request)
    {
        return view('confirmation', [
            'nom' => $request->nom,
            'prenom' => $request->prenom
        ]);
    }
    
    /**
     * Gère l'inscription des nouveaux médecins.
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'nom' => 'required|string|max:200',
        'prenom' => 'required|string|max:200',
        'specialite' => 'required|string|max:200',
        'adresse' => 'required|string|max:200',
        'ville' => 'required|string|max:255',
        'telephone' => 'required|string|max:20',
        'numCertificat' => 'required|string|max:100|unique:nouveau_medecins',
        'email' => 'required|string|email|max:255|unique:nouveau_medecins',
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $nouveauMedecin = NouveauMedecin::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'specialite' => $request->specialite,
        'adresse' => $request->adresse,
        'ville' => $request->ville,
        'telephone' => $request->telephone,
        'numCertificat' => $request->numCertificat,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    event(new Registered($nouveauMedecin));

    // Authentifier l'utilisateur immédiatement après l'inscription
    Auth::login($nouveauMedecin);

    // Rediriger vers la page de confirmation avec les données nécessaires
    return redirect()->route('medecin.confirmation', [
        'nom' => $request->nom,
        'prenom' => $request->prenom
    ]);
}

}
