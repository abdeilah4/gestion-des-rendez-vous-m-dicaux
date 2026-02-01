@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0 text-primary">Liste des Médecins</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3">Nom</th>
                            <th class="py-3">Email</th>
                            <th class="py-3">Spécialité</th>
                            <th class="py-3 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($medecin as $medcin)
                        <tr>
                            <td class="align-middle">
                                <strong>{{ $medcin->prenom }} {{ $medcin->nom }}</strong>
                            </td>
                            <td class="align-middle">
                                <a href="mailto:{{ $medcin->email }}" class="text-decoration-none">{{ $medcin->email }}</a>
                            </td>
                            <td class="align-middle">
                                <span class="badge bg-primary bg-opacity-10 text-primary">{{ $medcin->specialite }}</span>
                            </td>
                            <td class="align-middle text-end">
                                <form action="{{ route('medecins.destroy', $medcin->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce médecin ?')">
                                        <i class="fas fa-trash-alt me-1"></i> Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if($medecin->isEmpty())
        <div class="card-body text-center py-4">
            <div class="text-muted">Aucun médecin trouvé</div>
        </div>
        @endif
    </div>
</div>

<!-- Inclure Font Awesome pour les icônes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">