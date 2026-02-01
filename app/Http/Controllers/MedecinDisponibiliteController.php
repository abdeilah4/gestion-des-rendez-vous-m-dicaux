<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Disponibilite;
use App\Models\Medecin;

class MedecinDisponibiliteController extends Controller
{
    // Afficher les disponibilités du médecin connecté
    public function index()
    {
        // Récupérer les disponibilités du médecin connecté
        $medecin = Auth::guard('medecin')->user();
        $disponibilites = Disponibilite::where('medecin_id', $medecin->id)->get();

        return view('medecins.disponibilites.index', compact('disponibilites'));
    }

    // Afficher le formulaire pour ajouter une disponibilité
    public function create()
    {
        return view('medecins.disponibilites.create');
    }

    // Enregistrer une nouvelle disponibilité
    
    public function store(Request $request)
    {
        $request->validate([
            'jour' => 'required|string',  // Nom du jour (ex: "Lundi")
            'heures' => 'required|array', // Liste des heures sélectionnées
        ]);
    
        $medecin = Auth::guard('medecin')->user();
    
        foreach ($request->heures as $heure) {
            Disponibilite::create([
                'medecin_id' => $medecin->id,
                'jour' => $request->jour,
                'heure' => $heure,
                'statut' => 'disponible',
            ]);
        }
    
        return redirect()->route('medecins.disponibilites.index')->with('success', 'Disponibilités ajoutées avec succès.');
    }
    


    // Formulaire de modification de disponibilité
    public function edit($id)
    {
        $disponibilite = Disponibilite::findOrFail($id);
        return view('medecins.disponibilites.edit', compact('disponibilite'));
    }

    // Mettre à jour une disponibilité
    public function update(Request $request, $id)
    {
        $request->validate([
            'jour' => 'required|date',
            'heure' => 'required|date_format:H:i',
        ]);

        $disponibilite = Disponibilite::findOrFail($id);
        $disponibilite->update([
            'jour' => $request->jour,
            'heure' => $request->heure,
            'statut' => 'disponible',
        ]);

        return redirect()->route('medecins.disponibilites.index')->with('success', 'Disponibilité mise à jour avec succès.');
    }

    // Supprimer une disponibilité
    public function destroy($id)
    {
        Disponibilite::destroy($id);

        return redirect()->route('medecins.disponibilites.index')->with('success', 'Disponibilité supprimée avec succès.');
    }
}
