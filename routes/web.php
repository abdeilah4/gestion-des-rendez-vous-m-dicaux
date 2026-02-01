<?php

use App\Http\Controllers\MedecinController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\MedecinLoginController;
use App\Http\Controllers\DisponibiliteController;
use App\Http\Controllers\Auth\NouveauMedecinController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\AdminMedecinController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ✅ Routes d'authentification des médecins
Route::get('m/login', [MedecinLoginController::class, 'showLoginForm'])->name('medecin.login');
Route::post('m/login', [MedecinLoginController::class, 'login']);
Route::post('m/logout', [MedecinLoginController::class, 'logout'])->name('medecin.logout');

// ✅ Routes d'inscription des médecins
Route::get('/nouveau-medecin/register', [NouveauMedecinController::class, 'create'])->name('medecin.register');
Route::post('/nouveau-medecin/register', [NouveauMedecinController::class, 'store']);
Route::get('/nouveau-medecin/confirmation', [NouveauMedecinController::class, 'confirmation'])->name('medecin.confirmation');

// ✅ Routes sécurisées pour les médecins (nécessite `medecin.auth`)
// ✅ Routes sécurisées pour les médecins
Route::middleware('medecin.auth')->group(function () {
    Route::get('medecin/home', function () {
        return view('medecins.dashboard'); // Affiche le tableau de bord du médecin
    })->name('medecins.dashboard');
});

Route::get('/medecins/rendezvous', [RendezVousController::class, 'index'])->name('rendezvous.index');

use App\Http\Controllers\MedecinDisponibiliteController;

Route::middleware('auth:medecin')->prefix('medecin')->group(function() {
    Route::get('/disponibilites', [MedecinDisponibiliteController::class, 'index'])->name('medecins.disponibilites.index');
    Route::get('/disponibilites/create', [MedecinDisponibiliteController::class, 'create'])->name('medecin.disponibilites.create');
    Route::post('/disponibilites', [MedecinDisponibiliteController::class, 'store'])->name('medecin.disponibilites.store');
    Route::get('/disponibilites/{id}/edit', [MedecinDisponibiliteController::class, 'edit'])->name('medecin.disponibilites.edit');
    Route::put('/disponibilites/{id}', [MedecinDisponibiliteController::class, 'update'])->name('medecin.disponibilites.update');
    Route::delete('/disponibilites/{id}', [MedecinDisponibiliteController::class, 'destroy'])->name('medecin.disponibilites.destroy');
});

use App\Http\Controllers\ContactController;

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');


Route::post('/rendezvous/valider', [RendezVousController::class, 'valider'])->name('rendezvous.valider');
Route::post('/rendezvous/valider', [RendezVousController::class, 'valider'])->name('rendezvous.valider');


// ✅ Routes des disponibilités
Route::prefix('disponibilites')->group(function () {
    Route::get('/', [DisponibiliteController::class, 'index'])->name('disponibilites.index');
    Route::post('/', [DisponibiliteController::class, 'store'])->name('disponibilites.store');
    Route::delete('/{id}', [DisponibiliteController::class, 'destroy'])->name('disponibilites.destroy');

    // ⚠ Correction : "patientId" remplacé par "userId"
    Route::get('/details/{disponibiliteId}/{userId}', [DisponibiliteController::class, 'showDetails'])->name('disponibilites.details');
    Route::get('/pdf/{disponibiliteId}/{userId}', [DisponibiliteController::class, 'generatePdf'])->name('disponibilites.pdf');
});
Route::prefix('disponibilite')->group(function () {
    Route::get('/details/{disponibiliteId}/{userId}', [DisponibiliteController::class, 'showDetails'])->name('disponibilites.details');
});

// ✅ Route Dashboard principale
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// ✅ Routes protégées avec "auth"
Route::middleware(['auth'])->group(function () {
    Route::get('/medecins', [MedecinController::class, 'index'])->name('medecins.index');
    Route::get('/rendez-vous/{id}', [MedecinController::class, 'redez'])->name('redez');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth:medecin'])->get('/rendezvous/medecin', [RendezVousController::class, 'indexForMedecin'])->name('rendezvous.indexForMedecin');

Route::get('/rendezvous/medecin', [RendezVousController::class, 'indexForMedecin'])->name('rendezvous.indexForMedecin');
Route::get('/rendezvous', [RendezVousController::class, 'listeRendezVous'])->name('rendezvous.liste');


Route::get('/rendezvous', [RendezVousController::class, 'index'])->name('rendezvous.index');
Route::post('/rendezvous/{id}/update-status', [RendezVousController::class, 'updateStatus'])->name('rendezvous.updateStatus');
Route::delete('/rendezvous/{id}', [RendezVousController::class, 'destroy'])->name('rendezvous.destroy');

Route::delete('/rendezvous/{rendezvous}', [RendezVousController::class, 'destroy'])->name('rendezvous.destroy');
Route::get('/alogin', [AdminAuthController::class, 'showLoginForm'])->name('alogin');
Route::post('/alogin', [AdminAuthController::class, 'login'])->name('admin.doLogin');
    route::get('/demandes-medecins', [AdminMedecinController::class, 'demandes'])->name('admin.medecins.demandes');
    Route::post('/valider-medecin/{id}', [AdminMedecinController::class, 'valider'])->name('admin.medecins.valider');
    Route::get('/medecins/{id}', [AdminMedecinController::class, 'show'])->name('admin.medecins.show');
    route::get('/admin', [AdminMedecinController::class, 'admin']);
    Route::get('/aclient', [AdminMedecinController::class, 'admin'])->name('admin.medecins.index');
    Route::get('/amedcin', [AdminMedecinController::class, 'admin'])->name('admin.clients.index');
    route::get('/d', [AdminMedecinController::class, 'index']);
    Route::post('/d', [AdminMedecinController::class, 'index']);
    Route::delete('/medecins/{id}', [AdminMedecinController::class, 'destroy'])->name('medecins.destroy');
    Route::get('/dd', [AdminMedecinController::class, 'iindex']);
    Route::delete('/user/{id}', [AdminMedecinController::class, 'ddestroy'])->name('users.destroy');
// ✅ Inclusion des routes d'authentification Laravel
require __DIR__.'/auth.php';
