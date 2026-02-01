@extends('layouts.app')

@section('content')
<h1>Connexion Administrateur</h1>
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-sm border-0" style="width: 100%; max-width: 400px;">
        <div class="card-body p-4">
            <h2 class="text-center mb-4">Connexion Admin</h2>
            
            <form method="POST" action="{{ route('admin.doLogin') }}">
                @csrf
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" 
                           class="form-control" 
                           id="email" 
                           name="email" 
                           required 
                           autofocus
                           placeholder="admin@example.com">
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" 
                           class="form-control" 
                           id="password" 
                           name="password" 
                           required
                           placeholder="••••••••">
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-sign-in-alt me-2"></i> Se connecter
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Optionnel : Ajouter Font Awesome pour l'icône -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
