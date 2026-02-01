@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-lg" style="background-color: #f8f9fa;">
                <div class="card-header text-center py-4" style="background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);">
                    <h3 class="mb-0 text-white">
                        <i class="fas fa-hospital-user me-2"></i>Connexion Patient
                    </h3>
                </div>
                <div class="card-body p-5">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-4">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope me-2 text-primary"></i>Email
                            </label>
                            <input type="email" id="email" class="form-control form-control-lg" name="email" :value="old('email')" required autofocus autocomplete="username">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock me-2 text-primary"></i>Mot de passe
                            </label>
                            <input type="password" id="password" class="form-control form-control-lg" name="password" required autocomplete="current-password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                <label class="form-check-label" for="remember_me">
                                    <i class="fas fa-check-circle me-2 text-primary"></i>Se souvenir de moi
                                </label>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg" style="background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%); border: none;">
                                <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                            </button>
                        </div>

                        <div class="text-center mt-4">
                            @if (Route::has('password.request'))
                                <a class="text-decoration-none text-primary" href="{{ route('password.request') }}">
                                    <i class="fas fa-key me-2"></i>Mot de passe oublié ?
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3" style="background-color: #e9ecef;">
                    <p class="mb-0">Pas encore inscrit ? 
                        <a href="{{ route('register') }}" class="text-primary text-decoration-none">
                            <i class="fas fa-user-plus me-2"></i>Créer un compte
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
    .form-control:focus {
        border-color: #0dcaf0;
        box-shadow: 0 0 0 0.25rem rgba(13, 202, 240, 0.25);
    }
    .card {
        border: none;
        transition: transform 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
    }
</style>
@endsection

<