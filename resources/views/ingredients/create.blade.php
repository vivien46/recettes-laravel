@extends('layouts.app')

@section('title', 'Ajouter un ingrédient')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">Ajouter un ingrédient</h1>

    <form action="{{ route('ingredients.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="nom" class="block text-gray-700">Nom de l'ingrédient</label>
            <input type="text" name="nom" id="nom" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
        </div>
        
        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <textarea name="description" id="description" class="mt-1 block w-full border border-gray-300 rounded-md p-2"></textarea>
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
            Ajouter l'ingrédient
        </button>
    </form>
</div>
@endsection