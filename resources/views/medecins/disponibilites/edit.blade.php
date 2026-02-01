@extends('layouts.app')

@section('content')
<div class="container">
<a href="{{ url('/') }}" class="btn btn-outline-secondary">← Retour à l'Accueil</a>

    <h1 class="text-center mb-4">Modifier une Disponibilité</h1>

    <form action="{{ route('medecin.disponibilites.update', $disponibilite->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="jour">Jour</label>
            <input type="date" class="form-control @error('jour') is-invalid @enderror" name="jour" value="{{ old('jour', $disponibilite->jour) }}" required>
            @error('jour')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="heure">Heure</label>
            <input type="time" class="form-control @error('heure') is-invalid @enderror" name="heure" value="{{ old('heure', $disponibilite->heure) }}" required>
            @error('heure')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
