@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Tableau de bord Administrateur</h1>

<!-- Utilisateurs récemment ajoutés -->
<div class="bg-white p-6 shadow-md rounded-md mb-5">
    <h2 class="text-lg font-bold mb-4">Utilisateurs récemment ajoutés (5 derniers)</h2>
    @if($recentUsers->isEmpty())
    <p class="text-gray-700">Aucun utilisateur récemment ajouté.</p>
    @else
    <ul class="divide-y divide-gray-200">
        @foreach($recentUsers as $user)
        <li class="py-4 flex items-center">
            <!-- Ajout d'une icône d'utilisateur ou d'un avatar -->
            <div class="h-10 w-10 bg-gray-300 rounded-full flex items-center justify-center">
                <i class="fa-solid fa-user text-white"></i>
            </div>
            <div class="ml-4">
                <!-- Affichage du pseudo et de l'email avec un lien vers les détails -->
                <p class="text-gray-700 font-semibold">
                    <a href="{{ route('admin.users.show', $user->id) }}" class="text-blue-500 hover:underline">{{ $user->pseudo }}</a>
                </p>
                <p class="text-gray-500 text-sm">{{ $user->email }} - Inscrit le {{ $user->created_at->format('d/m/Y') }}</p>
            </div>
        </li>
        @endforeach
    </ul>
    @endif
</div>

<!-- Recettes récemment ajoutées avec images -->
<div class="bg-white p-6 shadow-md rounded-md mb-5">
    <h2 class="text-lg font-bold mb-4">Recettes récemment ajoutées (5 dernières)</h2>
    @if($recentRecipes->isEmpty())
    <p class="text-gray-700">Aucune recette récemment ajoutée.</p>
    @else
    <ul class="divide-y divide-gray-200">
        @foreach($recentRecipes as $recipe)
        <li class="py-4 flex items-center">
            <!-- Affichage de l'image de la recette -->
            <div class="h-16 w-16 bg-gray-300 rounded-full overflow-hidden flex items-center justify-center">
                @if($recipe->imageUrl)
                <img src="{{ asset('storage/' . $recipe->imageUrl) }}" alt="Image de {{ $recipe->titre }}" class="h-full w-full object-cover">
                @else
                <!-- Ajout d'une icône par défaut si l'image n'est pas présente -->
                <img src="https://placehold.co/500?text=Pas+d'image&font=roboto" alt="Image par défaut" class="h-full w-full object-cover">
                @endif
            </div>
            <div class="ml-4">
                <!-- Titre de la recette avec un lien vers les détails -->
                <p class="text-gray-700 font-semibold">
                    <a href="{{ route('recettes.show', $recipe->id) }}" class="text-blue-500 hover:underline">{{ $recipe->titre }}</a>
                </p>
                <p class="text-gray-500 text-sm"> Ajoutée le {{ $recipe->created_at->format('d/m/Y') }} par {{ $recipe->user ? $recipe->user->pseudo : 'Utilisateur inconnu' }}</p>
            </div>
        </li>
        @endforeach
    </ul>
    @endif
</div>

<!-- Grille de cartes pour les statistiques -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Carte pour les recettes -->
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
        <div class="p-4 bg-blue-500 rounded-full h-12 w-12 flex items-center justify-center">
            <i class="fas fa-utensils text-white text-2xl"></i>
        </div>
        <div class="ml-4">
            <h2 class="text-lg font-bold">Recettes</h2>
            <p class="text-gray-700">Total : {{ $recipesCount }}</p>
            <a href="{{ route('recettes.index') }}" class="text-blue-500 hover:underline">Voir les recettes</a>
        </div>
    </div>

    <!-- Carte pour les ingrédients -->
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
        <div class="p-4 bg-green-500 rounded-full h-12 w-12 flex items-center justify-center">
            <i class="fas fa-carrot text-white text-2xl"></i>
        </div>
        <div class="ml-4">
            <h2 class="text-lg font-bold">Ingrédients</h2>
            <p class="text-gray-700">Total : {{ $ingredientsCount }}</p>
            <a href="{{ route('ingredients.index') }}" class="text-blue-500 hover:underline">Voir les ingrédients</a>
        </div>
    </div>

    <!-- Carte pour les utilisateurs -->
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
        <div class="p-4 bg-yellow-500 rounded-full h-12 w-12 flex items-center justify-center">
            <i class="fa-solid fa-users text-white text-2xl"></i>
        </div>
        <div class="ml-4">
            <h2 class="text-lg font-bold">Utilisateurs</h2>
            <p class="text-gray-700">Total : {{ $usersCount }}</p>
            <a href="{{ route('admin.users') }}" class="text-blue-500 hover:underline">Voir les utilisateurs</a>
        </div>
    </div>
</div>

<!-- Section pour afficher les graphiques -->
<div class="mt-8 mb-12">
    <h2 class="text-xl font-bold mb-4 text-center">Statistiques Mensuelles</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Graphique pour les recettes -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-bold mb-2">Recettes par mois</h3>
            <canvas id="recipesChart" width="400" height="400" data-months="{{ json_encode($months) }}" data-recipes="{{ json_encode($recipeData) }}">
            </canvas>
        </div>

        <!-- Graphique pour la répartition des types de recettes -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-bold mb-2">Répartition des recettes par type</h3>
            <canvas id="typesChart" width="400" height="200" data-types='@json(array_keys($recipeTypeData))' data-counts='@json(array_values($recipeTypeData))'>
            </canvas>
        </div>
    </div>
</div>
@endsection
