@extends('layouts.app')

@section('content')

<div class="container-fluid vh-100 d-flex flex-column justify-content-center align-items-center bg-light"> 
    {{-- Page en plein écran avec fond gris clair --}}
    <a href="{{ url('/') }}" class="btn btn-outline-secondary">← Retour à l'Accueil</a>

    <div class="text-center">
        <h1 class="text-primary fw-bold">Bienvenue, Dr {{ Auth::guard('medecin')->user()->prenom }} {{ Auth::guard('medecin')->user()->nom }}</h1>
        <h3 class="text-secondary">Dans votre espace</h3>
    </div>

    {{-- Boutons en haut à droite --}}
    <div class="position-absolute top-0 end-0 m-4">
    <a href="{{ route('rendezvous.indexForMedecin') }}" class="btn btn-primary btn-lg me-2">Gérer vos rendez-vous</a>
    <a href="{{ route('medecins.disponibilites.index') }}" class="btn btn-secondary btn-lg me-2">Gérer vos disponibilités</a>
        <a href="{{ route('medecin.logout') }}" class="btn btn-danger btn-lg">Déconnexion</a>
    </div>

</div>
@endsection
