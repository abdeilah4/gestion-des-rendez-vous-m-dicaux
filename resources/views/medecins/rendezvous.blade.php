@extends('layouts.app')

@section('content')
<a href="{{ url('/') }}" class="btn btn-outline-secondary">← Retour à l'Accueil</a>

<div class="container-fluid vh-100 d-flex flex-column justify-content-center align-items-center bg-light"> 
    {{-- Page en plein écran avec fond gris clair --}}

    <div class="text-center">
        @if (Auth::guard('medecin')->check())
            <h1 class="text-primary fw-bold">Bienvenue, Dr {{ Auth::guard('medecin')->user()->prenom }} {{ Auth::guard('medecin')->user()->nom }}</h1>
        @else
            <h1 class="text-primary fw-bold">Bienvenue, Docteur</h1>
        @endif
        <h3 class="text-secondary">Voici vos rendez-vous</h3>
    </div>

    {{-- Liste des rendez-vous du médecin --}}
    <div class="mt-4 w-75">
        @if ($rendezvous->isEmpty())
            <p class="text-center">Aucun rendez-vous trouvé.</p>
        @else
        @foreach ($rendezvous as $rendezvousItem)
    <div class="rendezvous-item card mb-3">
        <div class="card-body">
            <h5 class="card-title">
                {{ $rendezvousItem->patient ? $rendezvousItem->patient->prenom . ' ' . $rendezvousItem->patient->nom : 'Patient inconnu' }}
            </h5>
            <p class="card-text">
                Date: {{ \Carbon\Carbon::parse($rendezvousItem->jour)->format('d/m/Y') }} à {{ $rendezvousItem->heure }}<br>
                Statut: <span id="statut-{{ $rendezvousItem->id }}" class="fw-bold text-{{ $rendezvousItem->statut == 'confirmé' ? 'success' : ($rendezvousItem->statut == 'annulé' ? 'danger' : 'warning') }}">
                    {{ ucfirst($rendezvousItem->statut) }}
                </span>
            </p>
            <div class="d-flex gap-2">
                <button class="btn btn-success confirm-btn" data-id="{{ $rendezvousItem->id }}">Confirmer</button>
                <button class="btn btn-warning cancel-btn" data-id="{{ $rendezvousItem->id }}">Annuler</button>
                <button class="btn btn-danger delete-btn" data-id="{{ $rendezvousItem->id }}">Supprimer</button>
            </div>
        </div>
    </div>
@endforeach


            {{-- Pagination --}}
            <div class="pagination">
                {{ $rendezvous->links() }} <!-- Pagination avec les liens -->
            </div>
        @endif
    </div>
</div>

{{-- Script AJAX pour gérer les actions sans recharger la page --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        function updateStatus(id, statut) {
            $.ajax({
                url: "/rendezvous/" + id + "/update-status",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    statut: statut
                },
                success: function (response) {
                    $("#statut-" + id).text(response.nouveauStatut)
                        .removeClass('text-warning text-danger text-success')
                        .addClass(response.color);
                }
            });
        }

        $(".confirm-btn").click(function () {
            let id = $(this).data("id");
            updateStatus(id, "confirmé");
        });

        $(".cancel-btn").click(function () {
            let id = $(this).data("id");
            updateStatus(id, "annulé");
        });

        $(".delete-btn").click(function () {
            let id = $(this).data("id");
            if (confirm("Voulez-vous vraiment supprimer ce rendez-vous ?")) {
                $.ajax({
                    url: "/rendezvous/" + id,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function () {
                        location.reload();
                    }
                });
            }
        });
    });
</script>
@endsection
