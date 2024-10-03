<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation de mot de passe</title>
    <style>
        /* Styles globaux pour l'email */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f7;
            color: #333;
        }

        .email-container {
            width: 100%;
            padding: 20px;
            background-color: #f4f4f7;
        }

        .email-content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .email-body {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }

        .email-footer {
            font-size: 12px;
            text-align: center;
            color: #888;
        }

        .button {
            display: inline-block;
            padding: 12px 24px;
            margin: 20px 0;
            font-size: 16px;
            color: #fff;
            background-color: #6366F1; /* couleur indigo-600 */
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
        }

        .button:hover {
            background-color: #4F46E5; /* couleur indigo-700 */
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-content">
            <!-- Header de l'email -->
            <div class="email-header">
                <h1>Réinitialisation de mot de passe</h1>
            </div>

            <!-- Corps de l'email -->
            <div class="email-body">
                <p>Bonjour {{ $pseudo }},</p>
                <p>Vous avez demandé la réinitialisation de votre mot de passe. Cliquez sur le bouton ci-dessous pour réinitialiser votre mot de passe :</p>

                <a href="{{ $url }}" class="button">Réinitialiser le mot de passe</a>

                <p>Si vous n'avez pas demandé cette réinitialisation, aucune action n'est requise de votre part.</p>

                <p>Ce lien de réinitialisation expirera dans {{ $countdown }} minutes.</p>
                <p>Ce message a été envoyé à l'adresse : {{ $email }}</p>

                <!-- Footer -->
                <div class="email-footer">
                    <p>Merci,<br>{{ config('app.name') }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>