@extends('layouts.app')

@section('title', 'Détail de l\'Ingrédient')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 capitalize">{{ $ingredient->nom }}</h1>
        <p>{{ $ingredient->description }}</p>

        <div class="mt-6">
            <a href="{{ route('ingredients.edit', $ingredient->id) }}" class="bg-blue-600 text-white px-4 py-3 rounded-lg hover:bg-blue-800">
                <i class="fas fa-edit"></i> Modifier
            </a>
            <a href="{{ route('ingredients.destroy', $ingredient->id) }}" class="bg-red-600 text-white px-4 py-3 rounded-lg hover:bg-red-800 ml-4" onclick="event.preventDefault(); if(confirm('Voulez-vous vraiment supprimer cet ingrédient ?')) { document.getElementById('delete-form').submit(); }">
                <i class="fas fa-trash-alt"></i> Supprimer
            </a>

            <form id="delete-form" action="{{ route('ingredients.destroy', $ingredient->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
@endsection