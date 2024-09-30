@component('mail::message')
# Réinitialisation du mot de passe

Cliquez sur le bouton ci-dessous pour réinitialiser votre mot de passe.

@component('mail::button', ['url' => $url])
Réinitialiser le mot de passe
@endcomponent

Si vous n'avez pas demandé la réinitialisation de votre mot de passe, aucune action supplémentaire n'est requise.

Merci,<br>
{{ config('app.name') }}
@endcomponent