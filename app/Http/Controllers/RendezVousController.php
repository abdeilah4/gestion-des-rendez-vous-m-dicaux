<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medecin;
use App\Models\RendezVous;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Disponibilite;
use Illuminate\Support\Facades\Auth;


class RendezVousController extends Controller
{
    public function create(Request $request)
    {
        $medecinId = $request->query('medecin_id');
        $timeSlot = $request->query('time_slot');

        // Récupérer les informations du médecin
        $medecin = Medecin::findOrFail($medecinId);

        // Afficher la vue avec les informations du médecin et l'heure du rendez-vous
        return view('rendez-vous.create', compact('medecin', 'timeSlot'));
    }
    // RendezVousController.php
    public function indexForPatient()
    {
        // Récupérer les rendez-vous associés au patient (l'utilisateur connecté)
        $rendezvous = auth()->user()->rendezvous()->paginate(10); // 10 résultats par page

        return view('patients.rendezvous', compact('rendezvous'));
    }


    
    public function indexForMedecin()
    {
        // Récupérer les rendez-vous pour le médecin authentifié
        $medecin = Auth::guard('medecin')->user();
        $rendezvous = $medecin->rendezvous()->paginate(10); // Pagination à 10 rendez-vous par page

        return view('medecins.rendezvous', compact('rendezvous'));
    }

    public function updateStatus($id, Request $request)
    {
        $rendezvous = RendezVous::findOrFail($id);
        $rendezvous->statut = $request->statut;

        // Si le statut du rendez-vous est confirmé, on met à jour le statut de la disponibilité
        if ($rendezvous->statut === 'confirmé') {
            // Trouver la disponibilité associée au rendez-vous
            $disponibilite = Disponibilite::where('medecin_id', $rendezvous->medecin_id)
                                        ->where('jour', $rendezvous->jour_nom)
                                        ->where('heure', $rendezvous->heure)
                                        ->first();

            // Si une disponibilité correspond, on change son statut à "réservé"
            if ($disponibilite) {
                $disponibilite->statut = 'réservé';
                $disponibilite->save();
            }
        }

        // Sauvegarder le rendez-vous
        $rendezvous->save();

        return redirect()->back()->with('success', 'Statut mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $rendezvous = RendezVous::findOrFail($id);
        $rendezvous->delete();

        return redirect()->back()->with('success', 'Rendez-vous supprimé avec succès.');
    }
    public function index()
    {
        // Correct the retrieval of the rendezvous records using pagination
        $rendezvous = Rendezvous::where('user_id', auth()->id())
                                ->orderBy('jour', 'desc')
                                ->paginate(10);  // This will return a Paginator instance
    
        // Pass the data to the view
        return view('rendezvous.index', compact('rendezvous'));
    }
    public function listeRendezVous()
    {
        // Charge les rendez-vous avec la relation "patient" en utilisant "user_id"
        $rendezvous = RendezVous::with('patient')->paginate(10);

        return view('rendezvous.index', compact('rendezvous'));
    }
    
    
    public function valider(Request $request)
    {
        // Valider les données
        $validated = $request->validate([
            'patient_id' => 'required|exists:users,id',  // On s'assure que le patient est un utilisateur dans la table 'users'
            'medecin_id' => 'required|exists:medecins,id',
            'disponibilite_id' => 'required|exists:disponibilites,id',
            'jour' => 'required|string',  // Le jour sous forme de chaîne (ex. "Mercredi")
            'heure' => 'required|date_format:H:i:s', // L'heure du rendez-vous
        ]);

        // Vérifier l'existence de l'utilisateur (patient)
        $patient = User::find($validated['patient_id']);
        if (!$patient) {
            return redirect()->back()->with('error', 'Utilisateur (patient) non trouvé');
        }

        // Vérifier l'existence du médecin
        $medecin = Medecin::find($validated['medecin_id']);
        if (!$medecin) {
            return redirect()->back()->with('error', 'Médecin non trouvé');
        }

        // Vérifier l'existence de la disponibilité
        $disponibilite = Disponibilite::find($validated['disponibilite_id']);
        if (!$disponibilite) {
            return redirect()->back()->with('error', 'Disponibilité non trouvée');
        }

        // Convertir le jour reçu (par exemple "Mercredi") en une date valide
        $jourNom = $validated['jour'];  // Le jour en texte, comme "Mercredi"
        $jourDate = Carbon::now()->startOfWeek()->addDays($this->getJourOffset($jourNom))->format('Y-m-d'); // Calculer la date en fonction du jour

        // Créer un nouveau rendez-vous
        $rendezvous = new RendezVous();
        $rendezvous->user_id = $validated['patient_id'];  // Assurez-vous que c'est bien un utilisateur
        $rendezvous->medecin_id = $validated['medecin_id'];
        $rendezvous->disponibilite_id = $validated['disponibilite_id'];
        $rendezvous->jour = $jourDate;  // Sauvegarder la date
        $rendezvous->jour_nom = $jourNom;  // Sauvegarder le nom du jour
        $rendezvous->heure = $validated['heure'];  // Sauvegarder l'heure du rendez-vous
        $rendezvous->statut = 'en attente';  // Statut par défaut
        $rendezvous->save();  // Sauvegarder le rendez-vous dans la base de données

        // Rediriger vers la page des détails du rendez-vous avec un message de succès
        return redirect()->route('disponibilites.details', [
            'disponibiliteId' => $validated['disponibilite_id'],
            'userId' => $validated['patient_id'],
        ])->with('rendezvous_valide', true);
    }



    /**
     * Cette fonction renvoie l'offset des jours en fonction du nom du jour.
     * Par exemple, "Lundi" => 0, "Mardi" => 1, "Mercredi" => 2, etc.
     */
    private function getJourOffset($jour)
    {
        $jours = [
            'Lundi' => 0,
            'Mardi' => 1,
            'Mercredi' => 2,
            'Jeudi' => 3,
            'Vendredi' => 4,
            'Samedi' => 5,
            'Dimanche' => 6,
        ];

        return isset($jours[$jour]) ? $jours[$jour] : 0; // Par défaut, retour 0 (Lundi)
    }

    public function store(Request $request)
    {
        $request->validate([
            'medecin_id' => 'required|exists:medecins,id',
            'time_slot' => 'required',
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email',
            'telephone' => 'required',
        ]);

        // Enregistrer le rendez-vous dans la base de données
        // Exemple :
        RendezVous::create([
            'medecin_id' => $request->medecin_id,
            'time_slot' => $request->time_slot,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
        ]);

        return redirect()->route('rendez-vous.index')->with('success', 'Rendez-vous confirmé !');
    }
}