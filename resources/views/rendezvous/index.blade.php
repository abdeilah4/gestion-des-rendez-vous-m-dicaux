@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Bouton de retour à l'accueil -->
        <a href="{{ url('/') }}" class="btn btn-outline-secondary">
            ← Retour à l'Accueil
        </a>
        <h1>Mes Rendez-vous</h1>
        <a href="{{ route('medecins.index') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nouveau Rendez-vous
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @forelse($rendezvous as $rdv)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title">
                                    Dr {{ $rdv->medecin->prenom }} {{ $rdv->medecin->nom }}
                                </h5>
                                <p class="text-muted mb-1">
                                    <i class="fas fa-stethoscope"></i> {{ $rdv->medecin->specialite }}
                                </p>
                                <p class="mb-1">
                                    <i class="fas fa-calendar-day"></i>
                                    {{ \Carbon\Carbon::parse($rdv->jour)->translatedFormat('l, d F Y') }}
                                </p>
                                <p class="mb-1">
                                    <i class="fas fa-clock"></i>
                                    {{ date('H:i', strtotime($rdv->heure)) }}
                                </p>

                                <span class="badge bg-{{ $rdv->statut === 'confirmé' ? 'success' : ($rdv->statut === 'annulé' ? 'danger' : 'warning') }}">
                                    {{ $rdv->statut }}
                                </span>
                            </div>
                            <div class="text-end">
                                <small class="text-muted">
                                    Créé le {{ $rdv->created_at->format('d/m/Y H:i') }}
                                </small>
                            </div>
                        </div>

                        <div class="mt-3">
                            <form action="{{ route('rendezvous.destroy', $rdv->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" 
                                    onclick="return confirm('Êtes-vous sûr de vouloir annuler ce rendez-vous ?')">
                                    <i class="fas fa-trash"></i> Annuler
                                </button>
                            </form>
                        </div>

                        <!-- Boutons de téléchargement uniquement si le statut est confirmé -->
                        @if($rdv->statut === 'confirmé')
                            <div class="mt-3">
                                <a href="{{ route('disponibilites.pdf', ['disponibiliteId' => $rdv->disponibilite_id, 'userId' => $rdv->user_id]) }}" 
                                    class="btn btn-primary mt-2">
                                    <i class="fas fa-file-pdf me-2"></i>Télécharger (.pdf)
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-calendar-times fa-2x mb-3"></i>
                    <h4>Aucun rendez-vous programmé</h4>
                    <p class="mb-0">Prenez votre premier rendez-vous avec un de nos médecins</p>
                </div>
            </div>
        @endforelse
    </div>

    @if($rendezvous->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $rendezvous->links() }}
        </div>
    @endif
</div>
@endsection
