@extends('layouts.app')

@section('title', 'Liste des recettes')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold text-center my-6">Liste des recettes</h1>
        
        <!-- Afficher le message de succès -->
        @if(session('success'))
        <div id="success-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 relative">
        <span>{{ session('success') }}</span>
        <button type="button" onclick="document.getElementById('success-message').style.display='none'" class="absolute top-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-700" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M14.348 5.652a1 1 0 010 1.414L11.414 10l2.934 2.934a1 1 0 11-1.414 1.414L10 11.414l-2.934 2.934a1 1 0 11-1.414-1.414L8.586 10 5.652 7.066a1 1 0 011.414-1.414L10 8.586l2.934-2.934a1 1 0 011.414 0z"/>
            </svg>
        </button>
    </div>
        @endif
        
        @if($recipes->isEmpty())
            <p class="text-center">Aucune recette trouvée.</p>
        @else
            <ul class="list-disc list-inside">
                @foreach($recipes as $recipe)
                    <li>
                        <a href="{{ route('recettes.show', $recipe->id) }}" class="text-blue-600 hover:underline">
                            {{ $recipe->titre }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection