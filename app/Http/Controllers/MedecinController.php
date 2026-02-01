<?php

namespace App\Http\Controllers;

use App\Models\Disponibilite;
use App\Models\Medecin;
use App\Models\Patient;
use Illuminate\Http\Request;


class MedecinController extends Controller
{
    // Afficher le formulaire d'inscription des médecins
    public function showRegistrationForm()
    {
        return view('auth.register-nouveau-medecin');  // Vue pour l'inscription d'un médecin
    }

    // Afficher le formulaire de connexion des médecins
    public function showLoginForm()
    {
        return view('auth.login-medecin');  // Vue pour la connexion d'un médecin
    }

    // Afficher la liste des médecins avec filtre par spécialité
    public function index(Request $request)
    {
        // Liste statique des spécialités (optionnel, à remplacer par une table si nécessaire)
        $specialites = ['Généraliste', 'Dentiste', 'Cardiologue', 'Dermatologue', 'Pédiatre', 'Ophtalmologue', 'Gynécologue', 'Neurologue', 'Orthopédiste', 'Psychiatre'];

        // Récupérer la spécialité sélectionnée par l'utilisateur
        $specialiteChoisie = $request->input('specialite');

        // Filtrer les médecins selon la spécialité sélectionnée
        $medecins = Medecin::when($specialiteChoisie, function ($query, $specialiteChoisie) {
            return $query->where('specialite', $specialiteChoisie);
        })->get();

        return view('medecins.index', compact('medecins', 'specialites', 'specialiteChoisie'));
    }

    // Afficher le formulaire pour ajouter un médecin
    public function create()
    {
        return view('medecins.create');
    }

    // Enregistrer un nouveau médecin
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'specialite' => 'required|string|max:255',
            'email' => 'required|email|unique:medecins',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        Medecin::create($request->all());

        return redirect()->route('medecins.index')->with('success', 'Médecin ajouté avec succès.');
    }

    // Afficher les disponibilités et informations pour prendre un rendez-vous
    public function redez($medecinId)
    {
        $medecin = Medecin::findOrFail($medecinId);
        $patient = auth()->user();
        
        // Récupérer les disponibilités du médecin
        $disponibilites = Disponibilite::where('medecin_id', $medecinId)->get();
        
        // Regrouper les disponibilités par jour et par heure
        $disponibilitesGrouped = $disponibilites->groupBy('jour')->map(function ($day) {
            return $day->keyBy(function ($item) {
                return substr($item->heure, 0, 5); // Extraire l'heure au format 'HH:MM'
            });
        });
    
        // Définir les jours de la semaine
        $daysOfWeek = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    
        return view('medecins.redez', compact('medecin', 'patient', 'disponibilitesGrouped', 'daysOfWeek'));
    }
    

}
