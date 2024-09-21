@extends('layouts.app')

@section('title', 'Modifier la recette')

@section('content')
    <div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10">
        <h1 class="text-3xl font-bold mb-6 text-gray-700">Modifier la recette</h1>

        <form action="{{ route('recettes.update', $recipe->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Titre -->
            <div class="mb-4">
                <label for="titre" class="block text-lg font-semibold text-gray-600">Titre de la recette</label>
                <input type="text" name="titre" id="titre" value="{{ old('titre', $recipe->titre) }}" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-lg font-semibold text-gray-600">Description</label>
                <textarea name="description" id="description" class="w-full px-4 py-2 border rounded-lg">{{ old('description', $recipe->description) }}</textarea>
            </div>

            <!-- Temps de préparation -->
            <div class="mb-4">
                <label for="temps_preparation" class="block text-lg font-semibold text-gray-600">Temps de préparation (minutes)</label>
                <input type="number" name="temps_preparation" id="temps_preparation" value="{{ old('temps_preparation', $recipe->temps_preparation) }}" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <!-- Temps de cuisson -->
            <div class="mb-4">
                <label for="temps_cuisson" class="block text-lg font-semibold text-gray-600">Temps de cuisson (minutes)</label>
                <input type="number" name="temps_cuisson" id="temps_cuisson" value="{{ old('temps_cuisson', $recipe->temps_cuisson) }}" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <!-- Temps de repos -->
            <div class="mb-4">
                <label for="temps_repos" class="block text-lg font-semibold text-gray-600">Temps de repos (minutes)</label>
                <input type="number" name="temps_repos" id="temps_repos" value="{{ old('temps_repos', $recipe->temps_repos) }}" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <!-- Temps total -->
            <div class="mb-4">
                <label for="temps_total" class="block text-lg font-semibold text-gray-600">Temps total (minutes)</label>
                <input type="number" name="temps_total" id="temps_total" value="{{ old('temps_total', $recipe->temps_total) }}" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <!-- Portion (nombre de personnes) -->
            <div class="mb-4">
                <label for="portion" class="block text-lg font-semibold text-gray-600">Portion (nombre de personnes)</label>
                <input type="number" name="portion" id="portion" value="{{ old('portion', $recipe->portion) }}" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <!-- Difficulté -->
            <div class="mb-4">
                <label for="difficulte" class="block text-lg font-semibold text-gray-600">Difficulté</label>
                <select name="difficulte" id="difficulte" class="w-full px-4 py-2 border rounded-lg">
                    <option value="facile" {{ old('difficulte', $recipe->difficulte) == 'facile' ? 'selected' : '' }}>Facile</option>
                    <option value="moyenne" {{ old('difficulte', $recipe->difficulte) == 'moyenne' ? 'selected' : '' }}>Moyenne</option>
                    <option value="difficile" {{ old('difficulte', $recipe->difficulte) == 'difficile' ? 'selected' : '' }}>Difficile</option>
                </select>
            </div>

            <!-- Type -->
            <div class="mb-4">
                <label for="type" class="block text-lg font-semibold text-gray-600">Type</label>
                <select name="type" id="type" class="w-full px-4 py-2 border rounded-lg">
                    <option value="entree" {{ old('type', $recipe->type) == 'entree' ? 'selected' : '' }}>Entrée</option>
                    <option value="plat" {{ old('type', $recipe->type) == 'plat' ? 'selected' : '' }}>Plat</option>
                    <option value="dessert" {{ old('type', $recipe->type) == 'dessert' ? 'selected' : '' }}>Dessert</option>
                    <option value="boisson" {{ old('type', $recipe->type) == 'boisson' ? 'selected' : '' }}>Boisson</option>
                    <option value="autre" {{ old('type', $recipe->type) == 'autre' ? 'selected' : '' }}>Autre</option>
                </select>
            </div>

            <!-- Section Étapes de la recette -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-600 mb-2">Étapes</h3>
                <div id="steps-container">
                    <!-- Boucle pour afficher les étapes existantes -->
                    @foreach($recipe->steps as $step)
                        <div class="step mb-4 p-4 bg-blue-100 rounded-lg relative">
                            <h4 class="font-bold mb-2">Étape N°{{ $step->order }}</h4>
                            <input type="hidden" name="order[]" value="{{ $step->order }}">
                            <textarea name="steps[]" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Décrivez l'étape">{{ $step->description }}</textarea>
                            <!-- Bouton pour supprimer l'étape -->
                            <button type="button" class="bg-red-500 text-white rounded-md p-1 hover:bg-red-600 absolute top-2 right-2" onclick="this.parentElement.remove()">X</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-step" class="w-full bg-blue-500 text-white font-semibold p-2 rounded-lg hover:bg-blue-600 transition-colors duration-300">Ajouter une étape</button>
            </div>

            <!-- Ingrédients sélectionnés -->
<div class="mb-6">
    <h2 class="text-lg font-bold text-center text-gray-600 mb-2">Ingrédients</h2>
    
    <!-- Barre de recherche d'ingrédients -->
    <div class="mb-4">
        <label for="search-ingredient" class="block text-lg font-semibold text-gray-600 mb-2">Rechercher un ingrédient</label>
        <span class="text-red-500">Vous pouvez ajouter des ingrédients à votre recette en les recherchant ci-dessous.</span>
        <input type="text" id="search-ingredient" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="Tapez un ingrédient..." autocomplete="off">
        <div id="search-results" class="mt-2"></div> <!-- Conteneur pour afficher les résultats -->
    </div>

    <!-- Conteneur des ingrédients sélectionnés -->
    <div id="selected-ingredients" class="mb-6">
        <h3 class="text-lg font-semibold text-gray-600 mb-2">Ingrédients sélectionnés :</h3>
        
        <!-- Ici on affiche les ingrédients existants pour cette recette -->
        @foreach($recipe->ingredients as $ingredient)

            <div class="flex items-center mb-2 selected-ingredient" data-ingredient-id="{{ $ingredient->id }}">
                <input type="checkbox" name="ingredients[]" value="{{ $ingredient->id }}" id="ingredient_{{ $ingredient->id }}" class="mr-2 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" checked>
                <label for="ingredient_{{ $ingredient->id }}" class="text-gray-600">{{ $ingredient->nom }}</label>

                <!-- Champs pour la quantité associée à chaque ingrédient -->
                <input type="text" name="quantites[{{ $ingredient->id }}]" value="{{ $ingredient->pivot->quantite_numeric }}" class="ml-4 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Quantité">

                <!-- Sélection de l'unité de mesure -->
                <select name="unites[{{ $ingredient->id }}]" class="ml-4 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="g" {{ $ingredient->pivot->quantite_unite == 'g' ? 'selected' : '' }}>g</option>
                    <option value="kg" {{ $ingredient->pivot->quantite_unite == 'kg' ? 'selected' : '' }}>kg</option>
                    <option value="ml" {{ $ingredient->pivot->quantite_unite == 'ml' ? 'selected' : '' }}>ml</option>
                    <option value="cl" {{ $ingredient->pivot->quantite_unite == 'cl' ? 'selected' : '' }}>cl</option>
                    <option value="l" {{ $ingredient->pivot->quantite_unite == 'l' ? 'selected' : '' }}>l</option>
                    <option value="cuillère à soupe" {{ $ingredient->pivot->quantite_unite == 'cuillère à soupe' ? 'selected' : '' }}>cuillère à soupe</option>
                    <option value="cuillère à café" {{ $ingredient->pivot->quantite_unite == 'cuillère à café' ? 'selected' : '' }}>cuillère à café</option>
                    <option value="unité" {{ $ingredient->pivot->quantite_unite == 'unité' ? 'selected' : '' }}>unité</option>
                    <option value="feuille" {{ $ingredient->pivot->quantite_unite == 'feuille' ? 'selected' : '' }}>feuille</option>
                    <option value="tranche" {{ $ingredient->pivot->quantite_unite == 'tranche' ? 'selected' : '' }}>tranche(s)</option>
                </select>

                <!-- Bouton de suppression de l'ingrédient -->
                <button type="button" class="ml-2 px-2 bg-red-500 text-white rounded-md hover:bg-red-600" onclick="this.parentElement.remove()">X</button>
            </div>
        @endforeach
    </div>
            </div>

            <!-- Bouton de soumission -->
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Mettre à jour la recette</button>
        </form>
    </div>
@endsection