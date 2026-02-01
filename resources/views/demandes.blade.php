@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Demandes des Médecins</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Spécialité</th>
                            <th scope="col" style="width: 200px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($demandes as $demande)
                        <tr>
                            <td>{{ $demande->prenom }} {{ $demande->nom }}</td>
                            <td>{{ $demande->email }}</td>
                            <td>
                                <span class="badge badge-info">{{ $demande->specialite }}</span>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <form action="{{ route('admin.medecins.valider', $demande->id) }}" method="POST">
                                        @csrf
                                        <a href="/valider-medecin/{{ $demande->id }}">Valider</a> <!-- ça c'est en GET donc ERREUR -->

                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Ajoutez ces liens CDN pour les icônes Font Awesome si ce n'est pas déjà fait -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">