@component('mail::message')
# Bonjour {{ $user->pseudo }},

Merci de vous être inscrit sur notre site.

Avant de continuer, merci de cliquer sur le bouton ci-dessous pour vérifier votre adresse email.

<div style="text-align: center; margin: 20px 0;">
    <a href="{{ $url }}" target="_blank" style="
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        color: #ffffff;
        background-color: #667eea;
        border-radius: 5px;
        text-decoration: none;
        border: 1px solid #667eea;
        transition: background-color 0.3s ease;
    " onmouseover="this.style.backgroundColor='#5561da'" onmouseout="this.style.backgroundColor='#667eea'">
        Vérifiez votre email
    </a>
</div>

Si vous n'arrivez pas à cliquer sur le bouton, copiez-collez le lien suivant dans votre navigateur: [{{ $url }}]({{ $url }})
[Cliquez ici]({{$url}})

Merci,<br>
L'équipe de {{ config('app.name') }}
    
@endcomponent