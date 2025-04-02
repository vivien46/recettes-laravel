@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Connexion</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 message-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="block text-gray-700">Adresse e-mail</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-300 p-2 rounded-lg" required>
        </div>

        <div class="mb-4">
            <label for="mot_de_passe" class="block text-gray-700">Mot de passe</label>
            <div class="relative">
    <input type="password" id="mot_de_passe" name="mot_de_passe" class="w-full border border-gray-300 p-2 pr-10 rounded-lg" required>
    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 cursor-pointer toggle-password">
        <i class="fas fa-eye" id="eye-icon"></i>
    </span>
</div>
            <span><a href="{{ route('password.request') }}" class="text-blue-500 hover:underline">Mot de passe oublié ?</a></span>
            
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 transition-colors">Se connecter</button>
    </form>

    <div class="mt-4 text-center">
        <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Pas encore inscrit ? Créez un compte</a>
    </div>
</div>
@endsection