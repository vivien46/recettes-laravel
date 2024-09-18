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

            <!-- Ingrédients et quantités -->
            <div class="mb-4">
                <label class="block text-lg font-semibold text-gray-600">Ingrédients</label>
                @foreach($ingredients as $ingredient)
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="ingredients[]" value="{{ $ingredient->id }}" id="ingredient-{{ $ingredient->id }}" 
                            @if($recipe->ingredients->contains($ingredient->id)) checked @endif>
                        <label for="ingredient-{{ $ingredient->id }}" class="ml-2">{{ $ingredient->nom }}</label>
                        
                        <!-- Quantité pour chaque ingrédient -->
                        @if($recipe->ingredients->contains($ingredient->id))
                            <input type="text" name="quantites[{{ $ingredient->id }}]" value="{{ $recipe->ingredients->find($ingredient->id)->pivot->quantite }}" class="ml-2 w-24 px-2 py-1 border rounded-lg" placeholder="Quantité">
                        @else
                            <input type="text" name="quantites[{{ $ingredient->id }}]" class="ml-2 w-24 px-2 py-1 border rounded-lg" placeholder="Quantité">
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Bouton de soumission -->
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Mettre à jour la recette</button>
        </form>
    </div>
@endsection