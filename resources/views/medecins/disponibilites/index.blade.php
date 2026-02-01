@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ url('/') }}" class="btn btn-outline-secondary">← Retour à l'Accueil</a>

    <h1 class="text-center mb-4">Vos Disponibilités</h1>

    <a href="{{ route('medecin.disponibilites.create') }}" class="btn btn-success mb-4">Ajouter une Disponibilité</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @foreach($disponibilites as $disponibilite)
        <div class="card mb-3">
            <div class="card-body">
                <p><strong>Jour:</strong> {{ $disponibilite->jour }}</p>
                <p><strong>Heure:</strong> {{ $disponibilite->heure }}</p>

                <a href="{{ route('medecin.disponibilites.edit', $disponibilite->id) }}" class="btn btn-warning btn-sm">Modifier</a>

                <form action="{{ route('medecin.disponibilites.destroy', $disponibilite->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette disponibilité ?')">Supprimer</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
