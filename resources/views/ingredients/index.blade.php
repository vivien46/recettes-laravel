@extends('layouts.app')

@section('title', 'Liste des Ingrédients')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Liste des Ingrédients</h1>

        <div class="mb-4">
            <a href="{{ route('ingredients.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                Ajouter un ingrédient
            </a>
        </div>

        @if($ingredients->isEmpty())
            <p>Aucun ingrédient trouvé.</p>
        @else
            <table class="table-auto w-full bg-white shadow-md rounded-lg">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2">Nom</th>
                        <th class="px-4 py-2">Description</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ingredients as $ingredient)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $ingredient->nom }}</td>
                            <td class="px-4 py-2">{{ $ingredient->description }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('ingredients.show', $ingredient->id) }}" class="text-blue-600 hover:underline">Voir</a>
                                <a href="{{ route('ingredients.edit', $ingredient->id) }}" class="text-yellow-600 hover:underline ml-4">Modifier</a>
                                <form action="{{ route('ingredients.destroy', $ingredient->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Voulez-vous vraiment supprimer cet ingrédient ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline ml-4">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection