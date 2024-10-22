@extends('layouts.app')

@section('title')

Modifier le profile {{ in_array(strtolower(substr($user->pseudo, 0, 1)), ['a', 'e', 'i', 'o', 'u', 'y', 'h']) ? "d'" : 'de ' }}{{ ucfirst($user->pseudo) }}

@endsection

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white shadow-md rounded-lg p-4">
        <h1 class="text-3xl font-bold mb-4">Modifier le profile {{ in_array(strtolower(substr($user->pseudo, 0, 1)), ['a', 'e', 'i', 'o', 'u', 'y', 'h']) ? "d'" : 'de ' }}{{ ucfirst($user->pseudo) }}</h1>

        <!-- Afficher les erreurs de validation s'il y en a -->
        @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            @if ($user->profile_image)
            <div class="mb-4">
                <label for="profile_image" class="block text-gray-700 mb-2">Image actuelle du profile</label>
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile image" class="w-32 h-32 object-cover rounded-full border">
                    <div>
                        <label for="profile_image" class="block text-gray-700">Changer l'image du profile</label>
                        <input type="file" name="profile_image" id="profile_image" class="mt-1">
                    </div>
                </div>
            </div>
            @else
            <div class="mb-4">
                <label for="profile_image" class="block text-gray-700">Image du profile</label>
                <input type="file" name="profile_image" id="profile_image" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500">
            </div>
            @endif

            <div class="mb-4">
                <label for="pseudo" class="block text-gray-700">Pseudo</label>
                <input type="text" name="pseudo" id="pseudo" value="{{ old('pseudo', $user->pseudo) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500">
            </div>
            <div class="mb-4">
                <label for="nom" class="block text-gray-700">Nom</label>
                <input type="text" name="nom" id="nom" value="{{ old('nom', $user->nom) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label for="prenom" class="block text-gray-700">Prénom</label>
                <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $user->prenom) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label for="date_naissance" class="block text-gray-700">Date de naissance</label>
                <input type="date" name="date_naissance" id="date_naissance" value="{{ old('date_naissance', $user->date_naissance ? $user->date_naissance->format('Y-m-d') : '') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500">
            </div>

            <div class="mb-6">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                    Sauvegarder les modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
