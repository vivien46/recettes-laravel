<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe</title>
</head>
<body>
    <h1>Réinitialisation du mot de passe</h1>

    <p>Bonjour {{ $pseudo }},</p>

    <p>Veuillez cliquer sur le bouton ci-dessous pour réinitialiser votre mot de passe.</p>

    <a href="{{ $url }}" style="background-color: blue; color: white; padding: 10px 20px; text-decoration: none;">Réinitialiser le mot de passe</a>

    <p>Si vous n'avez pas demandé la réinitialisation de votre mot de passe, aucune action supplémentaire n'est requise.</p>

    <p>Ce lien de réinitialisation du mot de passe expirera dans {{ $countdown }} minutes.</p>


    <footer>
        <p>Cordialement,</p>
        <p>L'équipe de {{ config('app.name') }}</p>
    <p>Ce message a été envoyé à l'adresse {{ $email }}.</p>
    </footer>
</body>
</html>
