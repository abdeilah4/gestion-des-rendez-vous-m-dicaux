<?php
// app/Http/Controllers/NouveauMedecinController.php
// app/Http/Controllers/NouveauMedecinController.php

namespace App\Http\Controllers;

use App\Models\NouveauMedecin;
use Illuminate\Http\Request;

class NouveauMedecinController extends Controller
{
    public function create()
    {
        return view('auth.register-nouveau-medecin');
    }

    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'specialite' => 'required|string|max:255',
            'email' => 'required|email|unique:nouveau_medecins',
            'telephone' => 'required|string|max:20',
            'ville' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed', // Correction ici
        ]);
        
        // Création du nouveau médecin
        $medecin = NouveauMedecin::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'specialite' => $request->specialite,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'ville' => $request->ville,
            'password' => Hash::make($request->password), // Correction ici
        ]);
    
        // Rediriger vers la page de confirmation
        return redirect()->route('medecin.confirmation')->with([
            'nom' => $request->nom,
            'prenom' => $request->prenom
        ]);
    }
    

    public function confirmation()
    {
        return view('confirmation');
    }
}
