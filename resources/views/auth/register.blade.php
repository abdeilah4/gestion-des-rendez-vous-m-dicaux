@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="mb-0">Création de compte</h3>
                </div>
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row">
                            <!-- Prénom -->
                            <div class="col-md-6 mb-4">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" id="prenom" class="form-control form-control-lg" name="prenom" :value="old('prenom')" required autofocus autocomplete="prenom">
                                <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                            </div>

                            <!-- Nom -->
                            <div class="col-md-6 mb-4">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" id="name" class="form-control form-control-lg" name="name" :value="old('name')" required autocomplete="name">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Email Address -->
                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control form-control-lg" name="email" :value="old('email')" required autocomplete="username">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Date de Naissance -->
                        <div class="mb-4">
                            <label for="date_naissance" class="form-label">Date de naissance</label>
                            <input type="date" id="date_naissance" class="form-control form-control-lg" name="date_naissance" :value="old('date_naissance')" required>
                            <x-input-error :messages="$errors->get('date_naissance')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" id="password" class="form-control form-control-lg" name="password" required autocomplete="new-password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                            <input type="password" id="password_confirmation" class="form-control form-control-lg" name="password_confirmation" required autocomplete="new-password">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-user-plus me-2"></i>S'inscrire
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    <p class="mb-0">Déjà inscrit ? 
                        <a href="{{ route('login') }}" class="text-primary text-decoration-none">
                            Se connecter
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
