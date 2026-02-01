<?php
namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
   
    public function showRegistrationForm()
    {
        // Replace 'auth.register' with the name of your registration view file
        return view('auth.register'); 
    }

    public function register(Request $request)
    {
        // Validation du formulaire
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:patients',
            'date_naissance' => 'required|date',
            'adresse' => 'required|string',
            'genre' => 'required|in:masculin,feminin',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        // Création du patient
        $patient = Patient::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'date_naissance' => $request->date_naissance,
            'adresse' => $request->adresse,
            'genre' => $request->genre,
            'password' => Hash::make($request->password),
        ]);
    
        // Redirection vers la page medecin.index après une inscription réussie
        return redirect()->route('medecin.index')->with('success', 'Inscription réussie, vous êtes redirigé vers votre tableau de bord.');
    }
    

}
