@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Bouton Retour à l'Accueil -->
    <a href="{{ url('/') }}" class="btn btn-outline-secondary mb-4">
        ← Retour à l'Accueil
    </a>

    <h2>Détails du Rendez-vous</h2>

    <!-- Informations sur le Médecin -->
    <div>
        <h4>Informations sur le Médecin</h4>
        <p><strong>Nom:</strong> {{ optional($medecin)->prenom }} {{ optional($medecin)->nom }}</p>
        <p><strong>Spécialité:</strong> {{ optional($medecin)->specialite }}</p>
    </div>

    <!-- Informations sur le Patient -->
    <div>
        <h4>Informations sur le Patient</h4>
        <p><strong>Nom:</strong> {{ optional($user)->prenom }} {{ optional($user)->nom }}</p>
        <p><strong>Âge:</strong> {{ $age ?? 'N/A' }} ans</p>
    </div>

    <!-- Informations sur le Rendez-vous -->
    <div>
        <h4>Informations sur le Rendez-vous</h4>
        <p><strong>Jour:</strong> {{ optional($disponibilite)->jour }}</p>
        <p><strong>Heure:</strong> {{ optional($disponibilite)->heure }}</p> 
    </div>

    <!-- Formulaire pour valider le rendez-vous -->
    <div class="mt-4">
        <form action="{{ route('rendezvous.valider') }}" method="POST">
            @csrf
            <input type="hidden" name="patient_id" value="{{ $user->id }}">  
            <input type="hidden" name="medecin_id" value="{{ $medecin->id }}">
            <input type="hidden" name="disponibilite_id" value="{{ $disponibilite->id }}">
            <input type="hidden" name="jour" value="{{ $disponibilite->jour }}">
            <input type="hidden" name="heure" value="{{ $disponibilite->heure }}">
            <button type="submit" class="btn btn-success" id="valider-btn">Valider le Rendez-vous</button>
        </form>
    </div>

    <!-- Feedback message after success -->
    @if(session('rendezvous_valide'))
        <div class="alert alert-success mt-3">
            Rendez-vous validé avec succès!
        </div>
    @endif
    <div class="mt-4">
    <h4>Code-Barres du Rendez-vous</h4>
    {!! DNS1D::getBarcodeHTML("RDV-{$disponibilite->id}-{$user->id}", 'C128') !!}
    <p class="text-muted">ID : RDV-{{ $disponibilite->id }}-{{ $user->id }}</p>
    </div>


</div>
@endsection
