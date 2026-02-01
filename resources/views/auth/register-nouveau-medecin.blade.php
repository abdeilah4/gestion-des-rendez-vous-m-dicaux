@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="mb-0">Inscription Médecin</h3>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('medecin.register') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" id="nom" name="nom" class="form-control form-control-lg" value="{{ old('nom') }}" required>
                                @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" id="prenom" name="prenom" class="form-control form-control-lg" value="{{ old('prenom') }}" required>
                                @error('prenom') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="specialite" class="form-label">Spécialité</label>
                                <input type="text" id="specialite" name="specialite" class="form-control form-control-lg" value="{{ old('specialite') }}" required>
                                @error('specialite') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="numCertificat" class="form-label">Numéro de Certificat</label>
                                <input type="text" id="numCertificat" name="numCertificat" class="form-control form-control-lg" value="{{ old('numCertificat') }}" required>
                                @error('numCertificat') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="adresse" class="form-label">Adresse</label>
                                <input type="text" id="adresse" name="adresse" class="form-control form-control-lg" value="{{ old('adresse') }}" required>
                                @error('adresse') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="ville" class="form-label">Ville</label>
                                <input type="text" id="ville" name="ville" class="form-control form-control-lg" value="{{ old('ville') }}" required>
                                @error('ville') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="telephone" class="form-label">Téléphone</label>
                                <input type="text" id="telephone" name="telephone" class="form-control form-control-lg" value="{{ old('telephone') }}" required>
                                @error('telephone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control form-control-lg" value="{{ old('email') }}" required>
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" id="password" name="password" class="form-control form-control-lg" required>
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-lg" required>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-user-plus me-2"></i>S'inscrire
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    <p class="mb-0">Vous avez déjà un compte ? 
                        <a href="{{ route('medecin.login') }}" class="text-primary text-decoration-none">
                            Se connecter ici
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
