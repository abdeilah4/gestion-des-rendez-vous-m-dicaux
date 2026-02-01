@extends('layouts.app')

@section('content')
<div class="container-fluid vh-100 d-flex flex-column justify-content-center align-items-center bg-light"> 
    {{-- Page en plein écran avec fond gris clair --}}

    <div class="text-center">
        <h1 class="text-primary fw-bold">Bienvenue, Dr {{ Auth::guard('medecin')->user()->prenom }} {{ Auth::guard('medecin')->user()->nom }}</h1>
        <h3 class="text-secondary">Dans votre espace</h3>
    </div>

    <div class="position-absolute top-0 end-0 m-4">
        <a href="{{ route('rendezvous.index') }}" class="btn btn-primary btn-lg me-2">Gérer vos rendez-vous</a>
        <a href="{{ route('disponibilites.index') }}" class="btn btn-secondary btn-lg">Gérer vos disponibilités</a>
    </div>

    <div class="mt-4">
        <a href="{{ route('medecin.logout') }}" class="btn btn-danger btn-lg">Déconnexion</a>
    </div>

</div>
@endsection
