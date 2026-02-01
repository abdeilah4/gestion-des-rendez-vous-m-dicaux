@extends('layouts.app')

@section('content')
<div class="table-responsive">
    <a href="{{ url('/') }}" class="btn btn-outline-secondary mb-3">← Accueil</a>
    
    <h2>Disponibilités du Dr {{ $medecin->prenom }} {{ $medecin->nom }}</h2>
    <p>Patient : {{ $patient->prenom }} {{ $patient->nom }}</p>

    <table class="table table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th>📆 Jour</th>
                @for ($hour = 8; $hour < 18; $hour++)
                    <th>{{ sprintf('%02d:00', $hour) }} - {{ sprintf('%02d:00', $hour + 1) }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
        @foreach ($daysOfWeek as $day)
    <tr>
        <td>{{ $day }}</td>
        @for ($hour = 8; $hour < 18; $hour++)
            @php
                $heureDebut = sprintf('%02d:00', $hour);
                $dispo = $disponibilitesGrouped->has($day) 
                    ? $disponibilitesGrouped[$day]->get($heureDebut)
                    : null;
                $isAvailable = $dispo && $dispo->statut === 'disponible';
            @endphp
            <td class="{{ $isAvailable ? 'bg-success' : 'bg-danger' }} text-white clickable-cell"
                data-dispo-id="{{ $dispo->id ?? '' }}"
                data-medecin-id="{{ $medecin->id }}"
                data-heure-debut="{{ $heureDebut }}"
                data-statut="{{ $isAvailable ? 'disponible' : 'indisponible' }}">
                {{ $heureDebut }}
            </td>
        @endfor
    </tr>
@endforeach

        </tbody>
    </table>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const cells = document.querySelectorAll('.clickable-cell');
    const patientId = {{ $patient->id }};

    cells.forEach(cell => {
        cell.addEventListener('click', function () {
            const isAvailable = this.dataset.statut === 'disponible';
            const dispoId = this.dataset.dispoId;
            const medecinId = this.dataset.medecinId;
            const heureDebut = this.dataset.heureDebut;

            if (isAvailable && dispoId) {
                window.location.href = `/disponibilite/details/${dispoId}/${patientId}?heure_debut=${heureDebut}`;
            } else {
                alert('Ce créneau n\'est pas disponible');
            }
        });
    });
});
</script>
@endsection
