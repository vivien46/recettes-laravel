<nav class="bg-gray-800 p-4 md:p-3">
    <div class="container mx-auto flex items-center justify-between flex-wrap md:flex-nowrap md:p-4">
        <!-- Section gauche : Accueil et Administration (visible uniquement sur écrans moyens et larges) -->
        <div class="hidden md:flex items-center space-x-4 md:space-x-6 sm:text-sm md:text-base xl:text-xl">
            <a href="{{ route('home') }}" class="text-white font-bold">Accueil</a>

            @if(auth()->check() && auth()->user()->role === 'admin')
                <!-- Menu Administration (visible uniquement si admin) -->
                <div class="relative flex items-center">
                    <button id="adminMenuButton" class="text-white font-bold focus:outline-none">
                        Administration
                    </button>
                    <div id="adminMenuDropdown" class="absolute hidden bg-gray-700 shadow-lg rounded-md top-16 md:top-14 z-50 w-48 dropdown-content">
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

       <!-- Section droite : informations utilisateur, déconnexion et menu burger pour mobile -->
<div class="flex items-center space-x-4 md:space-x-6 ml-auto sm:text-sm md:text-base xl:text-xl">
    @if(auth()->check())
        <span class="text-white sm:text-sm md:text-base xl:text-xl flex items-center">
            Bienvenue, {{ auth()->user()->pseudo }}
            @if(auth()->user()->role === 'admin')
                <span class="bg-red-500 text-white px-2 py-1 rounded-lg ml-2 flex items-center">
                    <i class="fa-solid fa-crown text-yellow-300 mr-1"></i>
                    <span class="hidden md:inline sm:text-md">Admin</span>
                </span>
            @endif
        </span>
        <form action="{{ route('logout') }}" method="POST" class="hidden md:block text-white bg-transparent hover:underline focus:outline-none ml-4">
            @csrf
            <button type="submit">
                Déconnexion
            </button>
        </form>
    @else
        <a href="{{ route('login') }}" class="text-white hover:underline">Connexion</a>
        <a href="{{ route('register') }}" class="text-white hover:underline">Inscription</a>
    @endif

    <!-- Menu burger pour petits écrans -->
    <button id="burgerButton" class="text-white focus:outline-none md:hidden ml-auto">
        <i class="fas fa-bars text-2xl"></i>
    </button>
</div>


    <!-- Contenu du menu burger (visible uniquement sur petits écrans) -->
    <div id="burgerMenu" class="hidden bg-gray-700 shadow-lg rounded-md mt-2 z-50 w-full md:hidden">
        <a href="{{ route('home') }}" class="block px-4 py-2 text-white text-sm hover:bg-indigo-500">Accueil</a>
        @if(auth()->check() && auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-white text-sm hover:bg-indigo-500">Dashboard Admin</a>
            <a href="{{ route('admin.users') }}" class="block px-4 py-2 text-white text-sm hover:bg-indigo-500">Gestion des utilisateurs</a>
            <a href="{{ route('recettes.index') }}" class="block px-4 py-2 text-white text-sm hover:bg-indigo-500">Recettes</a>
            <a href="{{ route('ingredients.index') }}" class="block px-4 py-2 text-white text-sm hover:bg-indigo-500">Ingrédients</a>
        @endif
        @if(auth()->check())
            <a href="#" onclick="document.getElementById('logout-form').submit();" class="block px-4 py-2 text-white hover:bg-indigo-500">Déconnexion</a>
        @endif
    </div>
</nav>
