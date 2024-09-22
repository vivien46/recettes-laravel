@extends('layouts.app')

@section('title', 'Liste des Ingrédients')

@section('content')
<div class="container mx-auto p-6 w-full">
    <h1 class="text-3xl font-bold mb-6">Liste des Ingrédients</h1>

    <div class="mb-4">
        <a href="{{ route('ingredients.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
            Ajouter un ingrédient
        </a>
    </div>

    <!-- Pagination en haut -->
    <div class="mt-6 mb-2 flex flex-col items-center">
            {{ $ingredients->links('vendor.pagination.tailwind') }}
    </div>

    @if($ingredients->isEmpty())
    <p>Aucun ingrédient trouvé.</p>
    @else
    <table class="w-full bg-white border text-center">
        <!-- Le `thead` avec la couleur de fond personnalisée -->
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="py-2 border-b text-center px-4">Nom</th>
                <th class="py-2 border-b text-center px-4">Description</th>
                <th class="py-2 border-b text-center px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ingredients as $ingredient)
            <tr>
                <td class="border-b px-4 py-2 text-center capitalize">{{ $ingredient->nom }}</td>
                <td class="border-b px-4 py-2">
                    <p class="align-middle text-justify">{{ $ingredient->description }}</p>
                </td>
                <td class="border-b px-4 py-2 text-center w-1/5">
                    <div class="flex justify-center items-center space-x-2">
                        <!-- Bouton Voir -->
                        <a href="{{ route('ingredients.show', $ingredient->id) }}" class="bg-blue-600 p-2 rounded hover:bg-blue-800 flex justify-center items-center">
                            <i class="fas fa-eye text-white"></i>
                        </a>
                        <!-- Bouton Modifier -->
                        <a href="{{ route('ingredients.edit', $ingredient->id) }}" class="bg-green-600 p-2 rounded hover:bg-green-800 flex justify-center items-center">
                            <i class="fas fa-edit text-white"></i>
                        </a>
                        <!-- Bouton Supprimer -->
                        <form action="{{ route('ingredients.destroy', $ingredient->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet ingrédient ?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 p-2 rounded hover:bg-red-800 flex justify-center items-center">
                                <i class="fas fa-trash-alt text-white"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-6 flex flex-col justify-around space-x-3">
        {{ $ingredients->links('vendor.pagination.tailwind') }}
        </div>
    @endif
</div>
@endsection
