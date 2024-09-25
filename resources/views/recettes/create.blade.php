@extends('layouts.app')

@section('title', 'Ajouter une recette')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10">
    <h1 class="text-3xl font-bold mb-6 text-gray-700">Ajouter une recette</h1>

    <!-- Message sur les champs obligatoires -->
    <p class="text-red-500 mb-4">Tous les champs marqués avec le symbole <span class="font-bold">*</span> sont obligatoires.</p>

    <form action="{{ route('recettes.store') }}" method="POST">
        @csrf

        <!-- Titre -->
        <div class="mb-4">
            <label for="titre" class="block text-lg font-semibold text-gray-600 mb-2">
                Titre de la recette <span class="text-red-500">*</span>
            </label>
            <input type="text" name="titre" id="titre" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Entrez le titre de la recette" required>
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="block text-lg font-semibold text-gray-600 mb-2">
                Description <span class="text-red-500">*</span>
            </label>
            <textarea name="description" id="description" rows="4" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Décrivez la recette" required></textarea>
        </div>

        <!-- Temps de préparation -->
        <div class="mb-4">
            <label for="temps_preparation" class="block text-lg font-semibold text-gray-600 mb-2">
                Temps de préparation (minutes)
            </label>
            <input type="number" name="temps_preparation" id="temps_preparation" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex : 20">
        </div>

        <!-- Temps de cuisson -->
        <div class="mb-4">
            <label for="temps_cuisson" class="block text-lg font-semibold text-gray-600 mb-2">
                Temps de cuisson (minutes)
            </label>
            <input type="number" name="temps_cuisson" id="temps_cuisson" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex : 30">
        </div>

        <!-- Temps de repos -->
        <div class="mb-4">
            <label for="temps_repos" class="block text-lg font-semibold text-gray-600 mb-2">
                Temps de repos (minutes)
            </label>
            <input type="number" name="temps_repos" id="temps_repos" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex : 60">
        </div>

        <!-- Temps total -->
        <div class="mb-4">
            <label for="temps_total" class="block text-lg font-semibold text-gray-600 mb-2">
                Temps total (minutes)
            </label>
            <input type="number" name="temps_total" id="temps_total" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex : 110">
        </div>

        <!-- Nombre de portions -->
        <div class="mb-4">
            <label for="portion" class="block text-lg font-semibold text-gray-600 mb-2">
                Nombre de portions
            </label>
            <input type="number" name="portion" id="portion" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex : 8">
        </div>

        <!-- Difficulté -->
        <div class="mb-4">
            <label for="difficulte" class="block text-lg font-semibold text-gray-600 mb-2">
                Difficulté <span class="text-red-500">*</span>
            </label>
            <select name="difficulte" id="difficulte" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="facile">Facile</option>
                <option value="moyenne">Moyenne</option>
                <option value="difficile">Difficile</option>
            </select>
        </div>

        <!-- Type de recette -->
        <div class="mb-4">
            <label for="type" class="block text-lg font-semibold text-gray-600 mb-2">
                Type de recette <span class="text-red-500">*</span>
            </label>
            <select name="type" id="type" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="entree">Entrée</option>
                <option value="plat">Plat</option>
                <option value="dessert">Dessert</option>
                <option value="boisson">Boisson</option>
                <option value="autre">Autre</option>
            </select>
        </div>

        <!-- Ingrédients barre de recherche avec quantité -->
        <div class="mb-6">
            <h2 class="text-lg font-bold text-center  text-gray-600 mb-2">Ingrédients</h2>
            <!-- Barre de recherche d'ingrédients -->
            <div class="mb-4">
                <label for="search-ingredient" class="block text-lg font-semibold text-gray-600 mb-2">Rechercher un ingrédient</label>
                <span class="text-red-500">Vous pouvez ajouter des ingrédients à votre recette en les recherchant ci-dessous.</span>
                <input type="text" id="search-ingredient" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="Tapez un ingrédient..." autocomplete="off">
                <div id="search-results" class="mt-2"></div> <!-- Conteneur pour afficher les résultats -->
            </div>

            <!-- Ingrédients sélectionnés -->
            <div id="selected-ingredients" class="mb-6">
                <h3 class="text-lg font-semibold text-gray-600 mb-2">Ingrédients sélectionnés :</h3>
                <!-- Ici on affichera les ingrédients sélectionnés -->
            </div>

            <!-- Section Étapes de la recette -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-600 mb-2">Étapes : </h3>
                <div id="steps-container"></div>
                <button type="button" id="add-step" class="mx-auto flex items-center bg-green-600 text-white font-semibold px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-300 space-x-2">
                    <i class="fas fa-plus"></i>
                    <span>Ajouter une étape</span>
                </button>
            </div>

        </div>

        <!-- Bouton de soumission -->
        <button type="submit" class="w-full bg-blue-500 text-white font-semibold p-3 rounded-lg hover:bg-blue-600 transition-colors duration-300">
            Ajouter la recette
        </button>
    </form>
</div>
@endsection
