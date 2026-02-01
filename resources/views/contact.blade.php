@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center text-primary mb-4">Contactez-nous</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <h4>Nos coordonnées</h4>
            <p><strong>Email :</strong> support@medrendezvous.com</p>
            <p><strong>Téléphone :</strong> +212 0666666666</p>
            <p><strong>Adresse :</strong> 123 Rue de la Santé, Beni Mellal , Maroc</p>
        </div>
        <div class="col-md-6">
            <h4>Envoyez-nous un message</h4>
            <form action="{{ route('contact.send') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" required>
                    @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control @error('message') is-invalid @enderror" name="message" rows="4" required></textarea>
                    @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>
    </div>
</div>
@endsection
