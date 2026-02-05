@extends('layouts.app')

@section('title', 'Mentions légales')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow">

    <h1 class="text-3xl font-bold text-gray-800 mb-6">
        Mentions légales
    </h1>

    <p class="text-gray-700 mb-4">
        Conformément à la loi, les informations suivantes précisent l’identité
        de l’éditeur du site <strong>{{ config('app.name') }}</strong>.
    </p>

    <ul class="text-gray-700 space-y-2">
        <li><strong>Éditeur :</strong> Association …</li>
        <li><strong>Email :</strong> contact@exemple.fr</li>
        <li><strong>Hébergeur :</strong> Synology NAS – France</li>
    </ul>

</div>
@endsection
