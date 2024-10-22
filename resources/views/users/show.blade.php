@extends('layouts.app')

@section('title')
Profile {{ in_array(strtolower(substr($user->pseudo, 0, 1)), ['a', 'e', 'i', 'o', 'u', 'y', 'h']) ? "d'" : 'de ' }}{{ ucfirst($user->pseudo) }}
@endsection

@section('content')
<div class="container mx-auto p-6">
    <!-- Étendre la card à pleine largeur avec centrage du contenu -->
    <div class="bg-white shadow-md rounded-lg p-4 w-full mx-auto md:w-3/4 lg:w-2/3 xl:w-1/2">
        <div class="flex flex-col items-center">
            <!-- Image de profil de l'utilisateur -->
            @if($user->profile_image)
            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Image profil {{ $user->pseudo }}" class="w-32 h-32 rounded-full object-cover mb-4">
            @else
            <img src="https://picsum.photos/200/200" alt="image profile {{ $user->pseudo}}" class="w-32 h-32 rounded-full object-cover mb-4">
            @endif

            <!-- Informations de l'utilisateur -->
            <div class="text-center">
                <div class="flex items-center space-x-2 mb-4">
                    <h1 class="text-4xl font-extrabold text-indigo-600">{{ $user->pseudo }}</h1>

                    <!-- L'icône de crayon avec un lien vers la page d'édition -->
                    <a href="{{ route('users.edit', $user->id) }}" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-pen text-2xl"></i>
                    </a>
                </div>
                <p class="text-lg text-gray-700 mb-2"><strong>Nom :</strong> {{ $user->nom }}</p>
                <p class="text-lg text-gray-700 mb-2"><strong>Prénom :</strong> {{ $user->prenom }}</p>
                <p class="text-lg text-gray-700 mb-2"><strong>Email :</strong> {{ $user->email }}</p>
                <p class="text-lg text-gray-700 mb-2"><strong>Date de naissance :</strong> {{ $user->date_naissance->format('d/m/Y') }}</p>
                <div class="bg-indigo-100 text-indigo-800 rounded-lg p-6 mt-6 shadow-md w-full md:w-3/4" title="Membre depuis le {{ $user->created_at->format('d/m/Y')}}">
                    <p class="text-lg font-bold">
                        <i class="fas fa-calendar-alt"></i> Membre depuis :
                    </p>
                    <p class="text-xl text-indigo-600" title="Membre depuis le {{ $user->created_at->format('d/m/Y')}}">
                        {{ $membreDepuis }}
                    </p>
                </div>

            </div>
        </div>

        <!-- Section des statistiques utilisateur -->
        {{-- <div class="mt-6">
            <h2 class="text-2xl font-semibold mb-4 text-center">Statistiques</h2>
        </div> --}}

        <!-- Liste des recettes publiées par l'utilisateur -->
        @if($user->recipes->isNotEmpty())
        <div class="mt-6">
            <h2 class="text-2xl font-semibold mb-4 text-center">Recettes publiées</h2>
            <p class="text-gray-600 m-5 text-lg"><strong>Nombre de recettes publiées :</strong> {{ $user->recipes->count() }}</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($user->recipes as $recipe)
                <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <!-- Image de la recette -->
                    <div class="h-48 bg-gray-200 overflow-hidden">
                        @if($recipe->image_display)
                        <img src="{{ $recipe->image_display }}" alt="Image de la recette {{ $recipe->titre }}" class="w-full h-full object-cover">
                        @else
                        <img src="https://picsum.photos/200/300" alt="Pas d'image disponible" class="w-full h-auto object-cover">
                        @endif

                    </div>
                    <!-- Titre de la recette -->
                    <div class="p-4">
                        <h3 class="text-xl font-bold mb-2">{{ ucfirst($recipe->titre) }}</h3>
                        <p class="text-gray-600 line-clamp-1 mb-4">{{ $recipe->description }}</p>
                        <span class="text-indigo-600 text-md mb-4">Créée le : {{ $recipe->created_at->format('d/m/Y') }}</span>
                        <a href="{{ route('recettes.show', $recipe->id) }}" class="inline-block bg-indigo-600 text-white px-4 py-2 mt-2 rounded-lg text-center transition duration-300 hover:bg-indigo-700 hover:shadow-md">
                            Voir la recette
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <p class="mt-6 text-gray-500">Cet utilisateur n'a publié aucune recette pour le moment.</p>
        @endif
    </div>
</div>
@endsection
