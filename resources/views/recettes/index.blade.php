@extends('layouts.app')

@section('title', 'Liste des Recettes')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Liste des Recettes</h1>

    <!-- Bouton d'ajout de recette -->
    <div class="mb-4 flex justify-between items-center">
        <a href="{{ route('recettes.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
            Ajouter une recette
        </a>
    </div>

        <!-- Pagination en haut -->
        <div class="m-6">
            {{ $recipes->links('vendor.pagination.tailwind') }}
        </div>

    <!-- Vérifie si la liste est vide -->
    @if($recipes->isEmpty())
    <p class="text-center text-gray-500">Aucune recette trouvée.</p>
    @else
    <!-- Affichage des recettes sous forme de cartes -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($recipes as $recipe)
        <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">
            <!-- Affichage de l'image de la recette -->
            <div class="h-48 bg-gray-200 overflow-hidden">
                @if($recipe->image)
                    <img src="{{ asset('storage/' . $recipe->image) }}" alt="Image de la recette {{ $recipe->titre }}" class="w-full h-full object-cover">
                @else
                    <img src="https://via.placeholder.com/300x200.png?text=Pas+d'image" alt="Pas d'image disponible" class="w-full h-full object-cover">
                @endif
            </div>
            <div class="p-4">
                <!-- Titre de la recette -->
                <h2 class="text-xl font-bold mb-2">{{ $recipe->titre }}</h2>
                
                <!-- Description abrégée de la recette -->
                <p class="text-gray-600 mb-4 line-clamp-3">{{ \Illuminate\Support\Str::limit($recipe->description, 100, '...') }}</p>
                
                <!-- Informations sur le temps, la difficulté et les portions -->
                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                    <span><i class="fas fa-clock mr-1"></i> {{ $recipe->temps_total ?? 'N/A' }} min</span>
                    <span><i class="fas fa-fire mr-1"></i> {{ ucfirst($recipe->difficulte) }}</span>
                    <span><i class="fas fa-utensils mr-1"></i> {{ $recipe->portion }} portion{{ $recipe->portion > 1 ? 's' : '' }}</span>
                </div>

                <!-- Boutons d'action -->
                <div class="flex justify-between space-x-1">
                    <a href="{{ route('recettes.show', $recipe->id) }}" 
                       class="bg-blue-600 text-white p-2 rounded hover:bg-blue-800 flex justify-center items-center w-8 h-8">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('recettes.edit', $recipe->id) }}" 
                       class="bg-green-600 text-white p-2 rounded hover:bg-green-800 flex justify-center items-center w-8 h-8">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('recettes.destroy', $recipe->id) }}" method="POST" 
                          onsubmit="return confirm('Voulez-vous vraiment supprimer cette recette ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-600 text-white p-2 rounded hover:bg-red-800 flex justify-center items-center w-8 h-8">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination en bas -->
    <div class="mt-6">
        {{ $recipes->links('vendor.pagination.tailwind') }}
    </div>
    @endif
</div>
@endsection