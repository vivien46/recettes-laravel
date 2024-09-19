@extends('layouts.app')

@section('title', 'Détail de l\'Ingrédient')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">{{ $ingredient->nom }}</h1>
        <p>{{ $ingredient->description }}</p>

        <div class="mt-6">
            <a href="{{ route('ingredients.edit', $ingredient->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">
                Modifier
            </a>
            <form action="{{ route('ingredients.destroy', $ingredient->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Voulez-vous vraiment supprimer cet ingrédient ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 ml-4">
                    Supprimer
                </button>
            </form>
        </div>
    </div>
@endsection