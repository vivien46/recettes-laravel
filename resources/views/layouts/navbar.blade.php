<nav class="bg-gray-800 p-8">
    <div class="container mx-auto flex justify-between">
        <!-- Lien vers l'accueil -->
        <div class="flex space-x-4">
            <a href="{{ route('home') }}" class="text-white font-bold">Accueil</a>

            <!-- Menu Administration (sur la gauche) -->
            @if(auth()->check() && auth()->user()->role === 'admin')
                <div class="relative">
                    <button id="adminMenuButton" class="text-white font-bold focus:outline-none">
                        Administration
                    </button>
                    <div id="adminMenuDropdown" class="absolute hidden bg-gray-700 shadow-lg rounded-md mt-2 z-50 w-48 dropdown-content">
                        <!-- Lien vers le Dashboard -->
                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-white hover:bg-indigo-500 hover:rounded-md">Dashboard Admin</a>

                        <!-- Sous-menu Gestion des utilisateurs -->
                        <div class="relative group">
                            <button class="text-white w-full text-left px-4 py-2 font-bold focus:outline-none">
                                Gestion des utilisateurs
                            </button>
                            <div class="absolute hidden bg-gray-600 shadow-lg rounded-md mt-2 z-50 w-48 left-full top-0 group-hover:block">
                                <a href="{{ route('admin.users') }}" class="block px-4 py-2 text-white hover:bg-indigo-500 hover:rounded-md">Liste des utilisateurs</a>
                                <a href="{{ route('admin.users.create') }}" class="block px-4 py-2 text-white hover:bg-indigo-500 hover:rounded-md">Ajouter un utilisateur</a>
                            </div>
                        </div>

                        <!-- Sous-menu Recettes -->
                        <div class="relative group">
                            <button class="text-white w-full text-left px-4 py-2 font-bold focus:outline-none">
                                Recettes
                            </button>
                            <div class="absolute hidden bg-gray-600 shadow-lg rounded-md mt-2 z-50 w-48 left-full top-0 group-hover:block">
                                <a href="{{ route('recettes.index') }}" class="block px-4 py-2 text-white hover:bg-indigo-500 hover:rounded-md">Liste des recettes</a>
                                <a href="{{ route('recettes.create') }}" class="block px-4 py-2 text-white hover:bg-indigo-500 hover:rounded-md">Ajouter une recette</a>
                            </div>
                        </div>

                        <!-- Sous-menu Ingrédients -->
                        <div class="relative group">
                            <button class="text-white w-full text-left px-4 py-2 font-bold focus:outline-none">
                                Ingrédients
                            </button>
                            <div class="absolute hidden bg-gray-600 shadow-lg rounded-md mt-2 z-50 w-48 left-full top-0 group-hover:block">
                                <a href="{{ route('ingredients.index') }}" class="block px-4 py-2 text-white hover:bg-indigo-500 hover:rounded-md">Liste des ingrédients</a>
                                <a href="{{ route('ingredients.create') }}" class="block px-4 py-2 text-white hover:bg-indigo-500 hover:rounded-md">Ajouter un ingrédient</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="flex items-center space-x-4">
            @if(auth()->check())
                <span class="text-white">Bienvenue, {{ auth()->user()->pseudo }}
                    @if(auth()->user()->role === 'admin')
                        <span class="bg-red-500 text-white px-2 py-1 rounded-lg ml-2">
                            <i class="fa-solid fa-crown text-yellow-300"></i> Admin
                        </span>
                    @endif
                </span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-white bg-transparent hover:underline focus:outline-none">
                        Déconnexion
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-white hover:underline">Connexion</a>
                <a href="{{ route('register') }}" class="text-white hover:underline">Inscription</a>
            @endif
        </div>
    </div>
</nav>
