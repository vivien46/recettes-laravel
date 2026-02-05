@extends('layouts.app')

@section('title', 'Politique de confidentialité')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow">

    <h1 class="text-3xl font-bold text-gray-800 mb-6">
        Politique de confidentialité
    </h1>

    <p class="text-gray-700 mb-4">
        Le site <strong>{{ config('app.name') }}</strong> respecte la vie privée
        de ses utilisateurs et s’engage à protéger leurs données personnelles.
    </p>

    <p class="text-gray-700 mb-4">
        Aucune donnée personnelle n’est collectée sans votre consentement.
    </p>

    <p class="text-gray-700">
        Conformément au RGPD, vous disposez d’un droit d’accès, de rectification
        et de suppression de vos données.
    </p>

</div>
@endsection
