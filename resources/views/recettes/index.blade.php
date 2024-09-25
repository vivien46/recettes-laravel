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
                @if($recipe->imageUrl)
                    <img src="{{ asset('storage/' . $recipe->imageUrl) }}" alt="Image de la recette {{ $recipe->titre }}" class="w-48 h-48 object-contain object-center">
                @else
                    <img src="https://via.placeholder.com/300x200.png?text=Pas+d'image" alt="Pas d'image disponible" class="w-48 h-48 object-contain">
                @endif
            </div>
            <div class="p-4">
                <!-- Titre de la recette avec icône d'étapes -->
                <h2 class="text-xl font-bold mb-2 flex items-center space-x-2">
                    <i class="fas fa-book-open text-indigo-600"></i>
                    <span>{{ $recipe->titre }}</span>
                </h2>
                
                <!-- Description abrégée de la recette -->
                <p class="text-gray-600 mb-4 line-clamp-3">{{ $recipe->description }}</p>
                
                <!-- Informations sur le temps, la difficulté et les portions -->
                <div class="flex items-center justify-between text-md text-semibold text-gray-500 mb-4">
                    <span><i class="fas fa-clock mr-1"></i> @if ($recipe->temps_total >= 60)
        {{ floor($recipe->temps_total / 60) }}h{{ str_pad($recipe->temps_total % 60, 2, '0', STR_PAD_LEFT) }}
    @else
        {{ $recipe->temps_total }}
    @endif min</span>
                    <span><i class="fas fa-fire mr-1"></i> {{ ucfirst($recipe->difficulte) }}</span>
                    <span><i class="fas fa-utensils mr-1"></i> {{ $recipe->portion }} personne{{ $recipe->portion > 1 ? 's' : '' }}</span>
                </div>

                <!-- Afficher les 3 premières étapes de la recette -->
                <div class="mb-4 text-sm text-gray-500">
                    @if($recipe->steps && $recipe->steps->count() > 0)
                        <p class="font-semibold">Étapes :</p>
                        <ul class="list-decimal ml-5">
                            @foreach($recipe->steps->take(2) as $step)
                                <li>{{ $step->description }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <!-- Boutons d'action -->
                <div class="flex justify-between space-x-1 mt-4">
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
