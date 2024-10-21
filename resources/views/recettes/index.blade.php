@extends('layouts.app')

@section('title', 'Liste des Recettes')

@section('content')

@if(session('success'))
<div class="bg-green-500 text-white p-4 rounded-lg mb-6" id="success-message">
    {{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="bg-red-500 text-white p-4 rounded-lg mb-6">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

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
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach ($recipes as $recipe)
        <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">
            <!-- Affichage de l'image de la recette -->
            <div class="h-48 bg-gray-200 overflow-hidden">
                @if($recipe->imageUrl)
                <img src="{{ asset('storage/' . $recipe->imageUrl) }}" alt="Image de la recette {{ $recipe->titre }}" class="w-full h-auto object-fill">
                @else
                <img src="https://via.placeholder.com/300x200.png?text=Pas+d'image" alt="Pas d'image disponible" class="w-full h-auto object-contain">
                @endif
            </div>
            <div class="p-6 space-y-4">
                <!-- Titre de la recette avec icône d'étapes -->
                <h2 class="text-2xl font-bold mb-4 flex items-center space-x-2">
                    <i class="fas fa-book-open text-indigo-600"></i>
                    <span>{{ ucfirst($recipe->titre) }}</span>
                </h2>

                <!-- Description abrégée de la recette avec bouton 'Voir plus' -->
                <p class="text-gray-600 line-clamp-2 mb-4">{{ $recipe->description }}</p>
                <a href="{{ route('recettes.show', $recipe->id) }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 text-sm transition-colors duration-200">
                    Voir plus
                </a>

                <!-- Informations sur le temps, la difficulté et les portions -->
                <div class="flex flex-col space-y-2 text-md text-semibold text-gray-500">
                    <div><i class="fas fa-clock mr-1"></i>
                        @if ($recipe->temps_total >= 60)
                        {{ floor($recipe->temps_total / 60) }}H{{ str_pad($recipe->temps_total % 60, 2, '0', STR_PAD_LEFT) }}
                        @else
                        {{ $recipe->temps_total }}
                        @endif
                    </div>
                    <div><i class="fas fa-fire mr-1"></i> {{ ucfirst($recipe->difficulte) }}</div>
                    <div><i class="fas fa-utensils mr-1"></i> {{ $recipe->portion }} personne{{ $recipe->portion > 1 ? 's' : '' }}</div>
                </div>

                <!-- Auteur et date de publication -->
                <div class="mt-6 text-xl text-gray-500 border-t pt-4">
                    <div class="flex justify-between">
                        <div><i class="fas fa-user mr-1 text-indigo-600"></i> Publiée par {{ $recipe->user->pseudo }}</div>
                        <div><i class="fas fa-clock mr-1 text-indigo-600"></i> {{ $recipe->created_at->diffForHumans() }}</div>
                    </div>
                </div>

                <!-- Boutons d'action avec icônes centrées et fond vert pour 'Voir la recette' -->
                <div class="flex justify-around items-center mt-4 space-x-2">
                    <a href="{{ route('recettes.show', $recipe->id) }}" class="bg-green-600 text-white p-3 rounded-full hover:bg-green-800 flex justify-center items-center">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('recettes.edit', $recipe->id) }}" class="bg-blue-600 text-white p-3 rounded-full hover:bg-blue-800 flex justify-center items-center">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('recettes.destroy', $recipe->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette recette ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white p-3 rounded-full hover:bg-red-800 flex justify-center items-center">
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
