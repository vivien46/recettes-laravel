<nav class="bg-gray-800 p-8">
    <div class="container mx-auto flex justify-between">
        <!-- Lien vers l'accueil -->
        <div class="flex space-x-4">
            <a href="{{ route('home') }}" class="text-white font-bold">Accueil</a>

            <!-- Dropdown Recettes -->
            <div class="relative group">
                <button class="text-white font-bold focus:outline-none" onclick="toggleDropdown('recettesDropdown')">
                    Recettes
                </button>
                <div id="recettesDropdown" class="absolute hidden bg-gray-700 shadow-lg rounded-md mt-4 z-50 w-48 dropdown-content">
                    <a href="{{ route('recettes.index') }}" class="block px-4 py-2 text-white hover:bg-indigo-500 hover:rounded-md">Liste des recettes</a>
                    <a href="{{ route('recettes.create') }}" class="block px-4 py-2 text-white hover:bg-indigo-500 hover:rounded-md">Ajouter une recette</a>
                </div>
            </div>

            <!-- Dropdown Ingrédients -->
            <div class="relative group">
                <button class="text-white font-bold focus:outline-none"  onclick="toggleDropdown('ingredientsDropdown')">
                    Ingrédients
                </button>
                <div  id="ingredientsDropdown" class="absolute hidden bg-gray-700 shadow-lg rounded-md mt-4 z-50 w-48 dropdown-content">
                    <a href="{{ route('ingredients.index') }}" class="block px-4 py-2 text-white hover:bg-indigo-500 hover:rounded-md">Liste des ingrédients</a>
                    <a href="{{ route('ingredients.create') }}" class="block px-4 py-2 text-white hover:bg-indigo-500 hover:rounded-md">Ajouter un ingrédient</a>
                </div>
            </div>
        </div>

        <div class="flex items-center space-x-4">
            @if(auth()->check())
                <span class="text-white">Bienvenue, {{ auth()->user()->pseudo }}</span>

                <!-- Liens spécifiques pour les administrateurs -->
                @if(auth()->user()->role === 'admin')
                    <div class="relative group">
                        <button class="text-white font-bold focus:outline-none"  onclick="toggleDropdown('adminDropdown')">
                            Admin
                        </button>
                        <div id="adminDropdown" class="absolute hidden bg-gray-700 shadow-lg rounded-md mt-4 z-50 w-48 dropdown-content">
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-white hover:bg-indigo-500 hover:rounded-md">Dashboard Admin</a>
                            <a href="{{ route('admin.users') }}" class="block px-4 py-2 text-white hover:bg-indigo-500 hover:rounded-md">Gestion des utilisateurs</a>
                        </div>
                    </div>
                @endif

                <!-- Lien de déconnexion -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-white bg-transparent hover:underline focus:outline-none">
                        Déconnexion
                    </button>
                </form>
            @else
                <!-- Lien de connexion et d'inscription si non connecté -->
                <a href="{{ route('login') }}" class="text-white hover:underline">Connexion</a>
                <a href="{{ route('register') }}" class="text-white hover:underline">Inscription</a>
            @endif
        </div>
    </div>
</nav>