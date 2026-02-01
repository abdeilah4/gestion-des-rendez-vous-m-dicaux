<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Réussie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 500px;
        }
        h1 {
            color: #28a745;
            font-size: 2rem;
        }
        p {
            font-size: 1rem;
            margin-bottom: 20px;
        }
        a {
            display: inline-block;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Votre inscription a été soumise avec succès !</h1>
        <p>Merci pour votre inscription, {{ $nom }} {{ $prenom }}.</p>
        <p>Votre dossier est en cours de traitement. Si vos informations sont validées, vous recevrez un e-mail contenant votre mot de passe pour vous connecter.</p>
        <a href="{{ route('medecin.login') }}">Retour à la page de connexion</a>
    </div>
</body>
</html>
