@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-lg" style="background-color: #f8f9fa;">
                <div class="card-header text-center py-4" style="background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);">
                    <h3 class="mb-0 text-white">
                        <i class="fas fa-user-md me-2"></i>Connexion Médecin
                    </h3>
                </div>
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('medecin.login') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope me-2 text-primary"></i>Email
                            </label>
                            <input type="email" class="form-control form-control-lg" id="email" name="email" required autofocus placeholder="votre@email.com">
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock me-2 text-primary"></i>Mot de passe
                            </label>
                            <input type="password" class="form-control form-control-lg" id="password" name="password" required placeholder="••••••••">
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg" style="background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%); border: none;">
                                <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3" style="background-color: #e9ecef;">
                    <p class="mb-0">Vous n'avez pas encore de compte ? 
                        <a href="{{ route('medecin.register') }}" class="text-primary text-decoration-none">
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
