@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ url('/') }}" class="btn btn-outline-secondary">← Retour à l'Accueil</a>
    <h1 class="text-center mb-4">Ajouter des Disponibilités</h1>
    
    <form action="{{ route('medecin.disponibilites.store') }}" method="POST">
        @csrf

        <!-- Sélection du jour -->
        <div class="form-group mb-3">
            <label for="jour">Sélectionnez un jour</label>
            <select class="form-control" id="jour" name="jour" required>
                <option value="">-- Choisissez un jour --</option>
                @foreach(['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'] as $jour)
                    <option value="{{ $jour }}">{{ $jour }}</option>
                @endforeach
            </select>
        </div>

        <!-- Heures disponibles -->
        <div class="form-group mb-3">
            <label>Choisissez les heures disponibles</label>
            <div id="heuresContainer" class="d-flex flex-wrap">
                @for ($heure = 8; $heure <= 18; $heure++)
                    <div class="form-check m-2">
                        <input class="form-check-input" type="checkbox" name="heures[]" value="{{ sprintf('%02d:00', $heure) }}" id="heure{{ $heure }}">
                        <label class="form-check-label" for="heure{{ $heure }}">
                            {{ sprintf('%02d:00', $heure) }}
                        </label>
                    </div>
                @endfor
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection
