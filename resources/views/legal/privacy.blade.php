@extends('layouts.app')

@section('title', 'Politique de confidentialité')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 text-gray-200">
    <h1 class="text-3xl font-bold mb-6">Politique de confidentialité</h1>

    <p class="mb-4">
        Le site <strong>{{ config('app.name') }}</strong> respecte la vie privée
        de ses utilisateurs et s’engage à protéger leurs données personnelles.
    </p>

    <p class="mb-4">
        Aucune donnée personnelle n’est collectée sans votre consentement.
    </p>
</div>
@endsection