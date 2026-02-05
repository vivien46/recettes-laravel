@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Inscription</h2>
    
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <label for="nom" class="block text-gray-700">Nom</label>
            <input type="text" id="nom" name="nom" value="{{ old('nom') }}" class="w-full border border-gray-300 p-2 rounded-lg" required>
        </div>

        <div class="mb-4">
            <label for="prenom" class="block text-gray-700">Prénom</label>
            <input type="text" id="prenom" name="prenom" value="{{ old('prenom') }}" class="w-full border border-gray-300 p-2 rounded-lg">
        </div>

        <div class="mb-4">
            <label for="pseudo" class="block text-gray-700">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo" value="{{ old('pseudo') }}" class="w-full border border-gray-300 p-2 rounded-lg">
        </div>

        <div class="mb-4">
            <label for="date_naissance" class="block text-gray-700">Date de naissance</label>
            <input type="date" id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}" class="w-full border border-gray-300 p-2 rounded-lg">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700">Adresse e-mail</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-300 p-2 rounded-lg" required>
        </div>

        <div class="mb-4">
            <label for="mot_de_passe" class="block text-gray-700">Mot de passe</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" class="w-full border border-gray-300 p-2 rounded-lg" required>
        </div>

        <div class="mb-4">
            <label for="mot_de_passe_confirmation" class="block text-gray-700">Confirmer le mot de passe</label>
            <input type="password" id="mot_de_passe_confirmation" name="mot_de_passe_confirmation" class="w-full border border-gray-300 p-2 rounded-lg" required>
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 transition-colors">S'inscrire</button>
    </form>

    <div class="mt-4 text-center">
        <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Déjà inscrit ? Connectez-vous</a>
    </div>
</div>
@endsection