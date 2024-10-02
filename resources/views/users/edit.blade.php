@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto mt-8">
        <div class="bg-white shadow-md rounded px-8 py-6">
            <h2 class="text-2xl font-bold mb-6">Éditer l'utilisateur</h2>

            <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="nom" class="block text-gray-700 font-bold mb-2">Nom :</label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom', $user->nom) }}" class="border border-gray-300 rounded w-full py-2 px-3 focus:outline-none focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label for="prenom" class="block text-gray-700 font-bold mb-2">Prénom :</label>
                    <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $user->prenom) }}" class="border border-gray-300 rounded w-full py-2 px-3 focus:outline-none focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label for="date_naissance" class="block text-gray-700 font-bold mb-2">Date de naissance :</label>
                    <input type="date" name="date_naissance" id="date_naissance" value="{{ old('date_naissance', $user->date_naissance) }}" class="border border-gray-300 rounded w-full py-2 px-3 focus:outline-none focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email :</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="border border-gray-300 rounded w-full py-2 px-3 focus:outline-none focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label for="pseudo" class="block text-gray-700 font-bold mb-2">Pseudo :</label>
                    <input type="text" name="pseudo" id="pseudo" value="{{ old('pseudo', $user->pseudo) }}" class="border border-gray-300 rounded w-full py-2 px-3 focus:outline-none focus:border-blue-500">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
@endsection