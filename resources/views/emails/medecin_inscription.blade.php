<!-- resources/views/emails/medecin_inscription.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre inscription est confirmée</title>
</head>
<body>
    <h1>Bienvenue, {{ $prenom }} {{ $nom }} !</h1>
    <p>Votre inscription a été acceptée. Voici vos informations de connexion :</p>
    <p><strong>Email :</strong> {{ $email }}</p>
    <p><strong>Mot de passe :</strong> {{ $password }}</p>
    <p>Vous pouvez maintenant vous connecter sur notre plateforme.</p>
    <a href="{{ route('login') }}">Se connecter</a>
</body>
</html>
