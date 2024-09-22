@extends('layouts.app')

@section('title', 'Modifier un ingrédient')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Modifier l'ingrédient</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('ingredients.update', $ingredient->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Nom de l'ingrédient -->
            <div class="mb-4">
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom de l'ingrédient <span class="text-red-500">*</span></label>
                <input type="text" name="nom" id="nom" value="{{ old('nom', $ingredient->nom) }}" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nom de l'ingrédient" required>
                @error('nom')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description de l'ingrédient -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
                <textarea name="description" id="description" rows="4" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Description de l'ingrédient" required>{{ old('description', $ingredient->description) }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Boutons d'action -->
            <div class="flex justify-between">
                <a href="{{ route('ingredients.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700" title="Retour à la page ingrédients">
                    Retour
                </a>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700" title="Mettre a jour l'ingrédient">
                    Mettre à jour l'ingrédient
                </button>
                <a href="{{ route('ingredients.destroy', $ingredient->id) }}" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700" title="Supprimer l'ingredient">
                    <i class="fas fa-trash"></i>
                </a>
            </div>
        </form>
    </div>
</div>
@endsection