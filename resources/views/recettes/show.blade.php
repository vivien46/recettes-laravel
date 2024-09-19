@extends('layouts.app')

@section('title', $recipe->titre)

@section('content')
<div class="container mx-auto">
    <!-- Card plus longue en hauteur -->
    <div class="bg-white shadow-md rounded-lg mb-6 min-h-[600px] max-w-3xl mx-auto">
        <!-- Card Header -->
        <div class="bg-gray-800 text-white p-6 rounded-t-lg">
            <h1 class="text-4xl font-bold">{{ $recipe->titre }}</h1>
        </div>

        <!-- Card Body -->
        <div class="p-6">
            <p class="text-lg mb-4">{{ $recipe->description }}</p>

            <!-- Affichage des informations principales avec icônes -->
            <div class="grid grid-cols-2 gap-6">
                <!-- Temps de préparation -->
                <div class="flex items-center space-x-2">
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" class="w-auto text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m5-10a9 9 0 11-9 9 9 9 0 019-9z"/>
                        </svg> -->
                    <img width="50" height="50" src="https://img.icons8.com/external-photo3ideastudio-lineal-photo3ideastudio/64/external-meal-gym-photo3ideastudio-lineal-photo3ideastudio.png" alt="external-meal-gym-photo3ideastudio-lineal-photo3ideastudio" />
                    <strong>Temps de préparation :</strong>
                    <p> {{ $recipe->temps_preparation }} minutes</p>
                </div>

                <!-- Temps de cuisson -->
                <div class="flex items-center  space-x-2">
                    <img width="50" height="50" src="https://img.icons8.com/ios/50/bake.png" alt="bake" />
                    <strong>Temps de cuisson : </strong>
                    <p>{{ $recipe->temps_cuisson }} minutes</p>
                </div>

                <!-- Temps de repos -->
                <div class="flex items-center  space-x-2">
                    <img width="50" height="50" src="https://img.icons8.com/ios/50/waiting-room.png" alt="waiting-room" />
                    <strong>Temps de repos : </strong>
                    <p>{{ $recipe->temps_repos }} minutes</p>
                </div>

                <!-- Temps total -->
                <div class="flex items-center  space-x-2">
                    <img width="50" height="50" src="https://img.icons8.com/ios/50/time--v1.png" alt="time--v1" />
                    <strong>Temps total :</strong>
                    <p>{{ $recipe->temps_total }} minutes</p>
                </div>
            </div>
        </div>

        <!-- Card Footer -->
        <div class="bg-gray-100 p-6 rounded-b-lg">
            <!-- Footer avec grille alignée en une ligne -->
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <strong>Difficulté :</strong>
                    <p>{{ ucfirst($recipe->difficulte) }}</p>
                </div>

                <div>
                    <strong>Type :</strong>
                    <p>{{ ucfirst($recipe->type) }}</p>
                </div>

                <div>
                    <img width="50" height="50" src="https://img.icons8.com/ios/50/cutlery.png" alt="cutlery" />
                    <p>{{ $recipe->portion }} personnes</p>
                </div>
            </div>
        </div>
        <!-- Afficher les ingrédients -->
        <h2 class="text-2xl font-bold mt-6">Ingrédients :</h2>
        <ul class="mb-6">
            @foreach($recipe->ingredients as $ingredient)
            <li>{{ $ingredient->pivot->quantite }}
                @if(Str::startsWith($ingredient->nom, ['a', 'e', 'o', 'u', 'h']))
                d' {{ $ingredient->nom }}
                @else
                de {{ $ingredient->nom }}
                @endif
            </li>
            @endforeach
        </ul>
    </div>


    <!-- Boutons d'édition et de suppression -->
    <div class="mt-6 flex space-x-4">
        <a href="{{ route('recettes.edit', $recipe->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            Modifier la recette
        </a>

        <form action="{{ route('recettes.destroy', $recipe->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette recette ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                Supprimer la recette
            </button>
        </form>
    </div>
</div>
@endsection