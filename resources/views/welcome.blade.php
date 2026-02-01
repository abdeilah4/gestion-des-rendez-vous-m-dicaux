@extends('layouts.app')

@section('title', 'Accueil - MedRendezVous')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="/images/logo.png" class="logo" alt="Logo" height="40">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="/medecins">Prendre un rendez-vous</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('medecin.login') }}">Vous êtes médecin ?</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contact.show') }}">Contactez-nous</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="min-vh-100 d-flex flex-column justify-content-center align-items-center text-white position-relative">
    <div class="background-slideshow">
        <div class="background-slide"></div>
        <div class="background-slide"></div>
        <div class="background-slide"></div>
    </div>

    <h1 class="fw-bold mb-4">Bienvenue sur MedRendezVous</h1>
    <p class="text-center mb-4" style="max-width: 600px;">
        Simplifiez la gestion de vos rendez-vous médicaux avec notre plateforme intuitive.
        Prenez, modifiez ou annulez vos rendez-vous en quelques clics.
    </p>
</div>

<div class="app-description">
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-center mb-4">
                <div class="feature-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <h3>Prise de Rendez-vous Facile</h3>
                <p>Prenez rendez-vous en quelques clics avec votre médecin préféré. Consultez les disponibilités en temps réel et choisissez le créneau qui vous convient.</p>
            </div>
            <div class="col-md-4 text-center mb-4">
                <div class="feature-icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <h3>Gestion des Médecins</h3>
                <p>Les médecins peuvent gérer facilement leurs disponibilités et leurs rendez-vous. Un tableau de bord intuitif pour une meilleure organisation.</p>
            </div>
            <div class="col-md-4 text-center mb-4">
                <div class="feature-icon">
                    <i class="fas fa-file-pdf"></i>
                </div>
                <h3>Documents Numériques</h3>
                <p>Générez et téléchargez vos confirmations de rendez-vous au format PDF, avec code-barres pour un suivi facile.</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .min-vh-100 {
        position: relative;
        overflow: hidden;
        height: 100vh;
        z-index: 1;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.7);
    }

    .background-slideshow {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
    }
.logo {
  width: 100px;   /* Increase or decrease as needed */
  height: auto;   /* Keeps proportions */
}

    .background-slide {
        position: absolute;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        opacity: 0;
        animation: fadeSlide 18s infinite;
        transition: opacity 1s ease-in-out;
    }

    .background-slide:nth-child(1) {
        background-image: url('/images/image1.jpg');
        animation-delay: 0s;
    }

    .background-slide:nth-child(2) {
        background-image: url('/images/image2.jpg');
        animation-delay: 6s;
    }

    .background-slide:nth-child(3) {
        background-image: url('/images/image3.jpg');
        animation-delay: 12s;
    }

    @keyframes fadeSlide {
        0%, 100% { opacity: 0; }
        10%, 30% { opacity: 1; }
        40%, 90% { opacity: 0; }
    }

    .app-description {
        background-color: #f8f9fa;
        padding: 3rem 0;
        margin-top: 2rem;
    }
    .feature-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: #0d6efd;
    }
</style>
@endsection
