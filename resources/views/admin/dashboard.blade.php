@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Tableau de bord Administrateur</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Carte pour les recettes -->
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
            <div class="p-4 bg-blue-500 rounded-full">
                <i class="fas fa-utensils text-white text-2xl"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-lg font-bold">Recettes</h2>
                <p class="text-gray-700">Total : {{ $recettesCount }}</p>
                <a href="{{ route('recettes.index') }}" class="text-blue-500 hover:underline">Voir les recettes</a>
            </div>
        </div>

        <!-- Carte pour les ingrédients -->
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
            <div class="p-4 bg-green-500 rounded-full">
                <i class="fas fa-carrot text-white text-2xl"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-lg font-bold">Ingrédients</h2>
                <p class="text-gray-700">Total : {{ $ingredientsCount }}</p>
                <a href="{{ route('ingredients.index') }}" class="text-blue-500 hover:underline">Voir les ingrédients</a>
            </div>
        </div>

        <!-- Carte pour les utilisateurs (exemple supplémentaire) -->
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
            <div class="p-4 bg-yellow-500 rounded-full">
                <i class="fa-solid fa-users text-white text-2xl"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-lg font-bold">Utilisateurs</h2>
                <p class="text-gray-700">Total : {{ $usersCount }}</p>
                <a href="{{ route('admin.users') }}" class="text-blue-500 hover:underline">Voir les utilisateurs</a>
            </div>
        </div>
    </div>
@endsection
