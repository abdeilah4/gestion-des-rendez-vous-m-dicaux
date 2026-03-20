<?php

namespace App\Http\Controllers;

use App\Models\Disponibilite;
use App\Models\Medecin;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Milon\Barcode\Facades\DNS2DFacade as DNS2D;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;


class DisponibiliteController extends Controller
{
    public function index()
    {
        $disponibilites = Disponibilite::all();
        return view('medecins.disponibilites.index', compact('disponibilites'));
    }

    public function showDetails($disponibiliteId, $userId, Request $request)
    {
        $disponibilite = Disponibilite::findOrFail($disponibiliteId);
        $user = User::findOrFail($userId);
        $medecin = Medecin::findOrFail($disponibilite->medecin_id);

        $heureDebut = $request->query('heure', $disponibilite->heure);
        $heureFin = Carbon::parse($heureDebut)->addHour()->format('H:i:s');
        $age = $user->date_naissance ? Carbon::parse($user->date_naissance)->age : 'N/A';

        $codeBarre = DNS2D::getBarcodeHTML("RDV-{$disponibilite->id}-{$user->id}", 'QRCODE');

        return view('disponibilites.details', compact(
            'disponibilite',
            'medecin',
            'user',
            'heureDebut',
            'heureFin',
            'age',
            'codeBarre'
        ));
    }

    public function generatePdf($disponibiliteId, $userId)
    {
        $disponibilite = Disponibilite::findOrFail($disponibiliteId);
        $user = User::findOrFail($userId);
        $medecin = Medecin::findOrFail($disponibilite->medecin_id);

        $data = [
            'disponibilite' => $disponibilite,
            'user' => $user,
            'medecin' => $medecin,
            'title' => 'Détails du Rendez-vous'
        ];

        $pdf = Pdf::loadView('disponibilites.pdf', $data);
        
        return $pdf->download('rendez-vous-' . $disponibilite->id . '.pdf');
    }

    public function generateHtml($disponibiliteId, $userId)
    {
        $disponibilite = Disponibilite::findOrFail($disponibiliteId);
        $user = User::findOrFail($userId);
        $medecin = Medecin::findOrFail($disponibilite->medecin_id);
        $age = $user->date_naissance ? Carbon::parse($user->date_naissance)->age : 'N/A';
        $heureFormatted = Carbon::parse($disponibilite->heure)->format('H:i');
        $codeBarre = DNS2D::getBarcodeHTML("RDV-{$disponibilite->id}-{$user->id}", 'QRCODE');

        $contenu = "
            <html>
                <head><title>Rendez-vous - Informations</title></head>
                <body>
                    <h1>Rendez-vous Médical</h1>
                    <h3>👨‍⚕️ Médecin</h3>
                    <p>Nom: {$medecin->prenom} {$medecin->nom}</p>
                    <p>Spécialité: {$medecin->specialite}</p>

                    <h3>🧑‍💼 Patient</h3>
                    <p>Nom: {$user->name}</p>
                    <p>Âge: {$age} ans</p>

                    <h3>📅 Rendez-vous</h3>
                    <p>Jour: {$disponibilite->jour}</p>
                    <p>Heure: {$heureFormatted}</p>

                    <h3>🔢 Code QR</h3>
                    <div>{$codeBarre}</div>
                    <p>ID: RDV-{$disponibilite->id}-{$user->id}</p>
                </body>
            </html>";

        return response($contenu)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', 'attachment; filename="rendezvous_' . $user->id . '.html"');
    }

    public function generateTxt($disponibiliteId, $userId)
    {
        $disponibilite = Disponibilite::findOrFail($disponibiliteId);
        $user = User::findOrFail($userId);
        $medecin = Medecin::findOrFail($disponibilite->medecin_id);

        $age = $user->date_naissance ? Carbon::parse($user->date_naissance)->age : 'N/A';
        $heureFormatted = Carbon::parse($disponibilite->heure)->format('H:i');

        $contenu = "============================\n\n";
        $contenu .= "👨‍⚕️ Médecin\n";
        $contenu .= "Nom: {$medecin->prenom} {$medecin->nom}\n";
        $contenu .= "Spécialité: {$medecin->specialite}\n\n";

        $contenu .= "🧑‍💼 Patient\n";
        $contenu .= "Nom: {$user->name}\n";
        $contenu .= "Âge: {$age} ans\n\n";

        $contenu .= "📅 Rendez-vous\n";
        $contenu .= "Jour: {$disponibilite->jour}\n";
        $contenu .= "Heure: {$heureFormatted}\n\n";

        $contenu .= "🔢 Code QR ID: RDV-{$disponibilite->id}-{$user->id}\n";

        return response($contenu)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', 'attachment; filename="rendezvous_' . $user->id . '.txt"');
    }

    public function showCalendar($medecinId, $userId)
    {
        $medecin = Medecin::findOrFail($medecinId);
        $user = User::findOrFail($userId);

        $disponibilites = Disponibilite::where('medecin_id', $medecinId)->get();
        $disponibilitesGrouped = $disponibilites->groupBy('jour')->map(function ($day) {
            return $day->keyBy(fn($item) => substr($item->heure, 0, 5));
        });

        $daysOfWeek = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

        return view('medecins.redez', compact('medecin', 'user', 'disponibilitesGrouped', 'daysOfWeek'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medecin_id' => 'required|exists:medecins,id',
            'user_id' => 'required|exists:users,id',
            'jour' => 'required|date',
            'heure' => 'required|date_format:H:i',
        ]);

        $heure = Carbon::createFromFormat('H:i', $request->heure);
        if ($heure->lt(Carbon::createFromTime(8, 0)) || $heure->gt(Carbon::createFromTime(18, 0))) {
            return back()->withErrors(['heure' => 'L\'heure doit être entre 8h00 et 18h00.']);
        }

        $jourNom = Carbon::parse($request->jour)->locale('fr')->translatedFormat('l');

        Disponibilite::create([
            'medecin_id' => $request->medecin_id,
            'user_id' => $request->user_id,
            'jour' => $jourNom,
            'heure' => $request->heure,
            'statut' => 'disponible',
        ]);

        return redirect()->route('disponibilites.index')->with('success', 'Disponibilité créée avec succès.');
    }
}
