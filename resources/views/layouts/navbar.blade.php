<nav class="bg-gray-800 p-4">
    <div class="container mx-auto flex justify-between">
        <!-- Lien vers l'accueil -->
        <div class="flex space-x-4">
            <a href="{{ url('/') }}" class="text-white font-bold">Accueil</a>

            <!-- Dropdown Recettes -->
            <div class="relative group">
                <button class="text-white font-bold focus:outline-none">
                    Recettes
                </button>
                <div class="absolute hidden group-hover:block bg-white shadow-lg rounded-md mt-2">
                    <a href="{{ route('recettes.index') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Liste des recettes</a>
                    <a href="{{ route('recettes.create') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Ajouter une recette</a>
                </div>
            </div>

            <!-- Dropdown Ingrédients -->
            <div class="relative group">
                <button class="text-white font-bold focus:outline-none">
                    Ingrédients
                </button>
                {{-- <div class="absolute hidden group-hover:block bg-white shadow-lg rounded-md mt-1">
                    <a href="{{ route('ingredients.index') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Liste des ingrédients</a>
                    <a href="{{ route('ingredients.create') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Ajouter un ingrédient</a>
                </div> --}}
            </div>
        </div>

        <!-- Placeholder pour la gestion des rôles utilisateur (User/Admin) -->
        <div>
            {{-- Pour plus tard : Ajouter des liens spécifiques selon le rôle --}}
            @if(auth()->check())
                <span class="text-white">Bienvenue, {{ auth()->user()->nom }}</span>
                {{-- Ajoute ici des liens supplémentaires pour les admins plus tard --}}
            @endif
        </div>
    </div>
</nav>
