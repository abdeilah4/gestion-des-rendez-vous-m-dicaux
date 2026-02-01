@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Prendre un rendez-vous</h1>
    <form action="{{ route('rendez-vous.store') }}" method="POST">
        @csrf
        <input type="hidden" name="medecin_id" value="{{ $medecin->id }}">
        <input type="hidden" name="time_slot" value="{{ $timeSlot }}">

        <div class="form-group">
            <label for="nom">Nom du patient</label>
            <input type="text" name="nom" id="nom" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="prenom">Prénom du patient</label>
            <input type="text" name="prenom" id="prenom" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email du patient</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="telephone">Téléphone du patient</label>
            <input type="text" name="telephone" id="telephone" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Confirmer le rendez-vous</button>
    </form>
</div>
@endsection