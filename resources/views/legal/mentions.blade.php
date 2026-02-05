@extends('layouts.app')

@section('title', 'Mentions légales')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 text-gray-200">
    <h1 class="text-3xl font-bold mb-6">Mentions légales</h1>

    <p class="mb-4">
        Conformément à la loi, les informations suivantes précisent l’identité
        de l’éditeur du site <strong>{{ config('app.name') }}</strong>.
    </p>

    <p class="mb-2"><strong>Éditeur :</strong> Association …</p>
    <p class="mb-2"><strong>Email :</strong> contact@exemple.fr</p>
    <p class="mb-2"><strong>Hébergeur :</strong> Synology NAS – France</p>
</div>
@endsection