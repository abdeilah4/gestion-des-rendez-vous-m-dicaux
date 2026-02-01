@extends('layouts.app')

@section('content')
<div class="container-fluid">
<a href="{{ url('/') }}" class="btn btn-outline-secondary">← Retour à l'Accueil</a>

    <!-- Barre de navigation en haut à droite -->
    <div class="d-flex justify-content-end p-3">
        @auth
            <!-- Formulaire de déconnexion -->
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">Se déconnecter</button>
            </form>
            
            <!-- Bouton pour afficher les rendez-vous -->
            <a href="{{ route('rendezvous.index') }}" class="btn btn-info ms-2">Afficher mes rendez-vous</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Se connecter</a>
            <a href="{{ route('register') }}" class="btn btn-primary">S'inscrire</a>
        @endauth
    </div>

    <div class="row">
        <!-- Filtres -->
        <div class="col-md-3 bg-light p-4">
            <h2 class="mb-4">Filtrer par spécialité</h2>
            <form method="GET" action="{{ route('medecins.index') }}" id="filter-form">
                <div class="mb-3">
                    <label for="specialite" class="form-label">Spécialité :</label>
                    <select name="specialite" id="specialite" class="form-select" onchange="document.getElementById('filter-form').submit();">
                        <option value="">Toutes les spécialités</option>
                        @foreach($specialites as $specialite)
                            <option value="{{ $specialite }}" {{ request('specialite') == $specialite ? 'selected' : '' }}>
                                {{ $specialite }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>

            <h2 class="mt-5">Recherche</h2>
            <form method="GET" action="{{ route('medecins.index') }}">
                <div class="mb-3">
                    <label for="search" class="form-label">Rechercher par nom ou spécialité :</label>
                    <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}" placeholder="Nom ou spécialité">
                </div>
                <button type="submit" class="btn btn-primary w-100">Rechercher</button>
            </form>
        </div>

        <!-- Liste des médecins -->
        <div class="col-md-9 p-4">
            <h1 class="mb-4">Trouvez un médecin au Maroc</h1>

            @forelse($medecins as $medecin)
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 class="text-primary">Dr {{ $medecin->prenom }} {{ $medecin->nom }}</h3>
                            <h5 class="text-muted">{{ $medecin->specialite }}</h5>
                            <p class="text-secondary">
                                <i class="fas fa-map-marker-alt"></i> {{ $medecin->adresse }}
                            </p>
                            <p>{{ $medecin->description }}</p>
                        </div>
                        
                        <div class="col-md-4 d-flex align-items-center justify-content-end">
                            @auth
                                <a href="{{ route('redez', $medecin->id) }}" class="btn btn-warning">Prendre Rendez-vous</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-warning">Prendre Rendez-vous</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <p class="text-center text-muted">Aucun médecin trouvé pour cette recherche.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
