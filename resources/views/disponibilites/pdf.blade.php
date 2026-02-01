<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .details {
            margin: 20px 0;
        }
        .section {
            margin-bottom: 20px;
        }
        .label {
            font-weight: bold;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .barcode {
            text-align: center;
            margin: 20px 0;
        }
        .barcode-id {
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Détails du Rendez-vous</h1>
    </div>

    <div class="details">
        <div class="section">
            <h2>Informations du Patient</h2>
            <p><span class="label">Nom:</span> {{ $user->name }}</p>
            <p><span class="label">Email:</span> {{ $user->email }}</p>
        </div>

        <div class="section">
            <h2>Informations du Médecin</h2>
            <p><span class="label">Nom:</span> Dr. {{ $medecin->prenom }} {{ $medecin->nom }}</p>
            <p><span class="label">Spécialité:</span> {{ $medecin->specialite }}</p>
        </div>

        <div class="section">
            <h2>Détails du Rendez-vous</h2>
            <p><span class="label">Jour:</span> {{ $disponibilite->jour }}</p>
            <p><span class="label">Heure:</span> {{ $disponibilite->heure }}</p>
            <p><span class="label">Statut:</span> {{ $disponibilite->statut }}</p>
        </div>

        <div class="barcode">
            {!! DNS1D::getBarcodeHTML("RDV-{$disponibilite->id}-{$user->id}", 'C128') !!}
            <p class="barcode-id">ID : RDV-{{ $disponibilite->id }}-{{ $user->id }}</p>
        </div>
    </div>

    <div class="footer">
        <p>Ce document a été généré automatiquement le {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</body>
</html>
