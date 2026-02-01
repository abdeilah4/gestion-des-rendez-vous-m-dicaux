<?php

namespace App\Http\Controllers;
use App\Models\NouveauMedecin;
use App\Models\Medecin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminMedecinController extends Controller {
    // Liste des demandes en attente
    public function demandes() {
        $demandes = NouveauMedecin::all();
        return view('demandes', compact('demandes'));
    }
    public function admin() {
        
        return view('admin');
    }

    // Valider une demande
    public function valider($id) {
        $demande = NouveauMedecin::findOrFail($id);

        // Copie vers la table medecins
        Medecin::create([
            'nom' => $demande->nom,
            'prenom' => $demande->prenom,
            'specialite' => $demande->specialite,
            'email' => $demande->email,
            'telephone' => $demande->telephone,
            'ville' => $demande->ville,
            'password' => $demande->password, 
        ]);

        // Suppression de la demande
        $demande->delete();

        return redirect()->route('demandes')
            ->with('success', 'Médecin validé avec succès !');
    }
    public function index()
    {
        $medecin = medecin::all();
        return view('medcinad', compact('medecin'));
    }
    public function destroy($id)
{
    $medecin = Medecin::findOrFail($id);
    $medecin->delete();
    
    return redirect()->route('medecins.index')
        ->with('success', 'Médecin supprimé avec succès');
}
public function iindex()
{
    $users = User::all(); // Récupère tous les utilisateurs
    return view('clientad', compact('users')); // Passe les utilisateurs à la vue
}

public function ddestroy($id)
{
    $user = User::findOrFail($id); // Trouve l'utilisateur
    $user->delete(); // Supprime l'utilisateur
    
    return redirect()->route('medcin.index') // Redirige vers la liste des utilisateurs
        ->with('success', 'Utilisateur supprimé avec succès');
}
}