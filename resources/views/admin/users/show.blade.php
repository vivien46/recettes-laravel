@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Détails de l'utilisateur : {{ ucfirst(strtolower($user->prenom)) }} {{ strtoupper($user->nom) }}</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <p><strong>Nom :</strong> {{ strtoupper($user->nom) }}</p>
        <p><strong>Prénom :</strong> {{ ucfirst(strtolower($user->prenom)) }}</p>
        <p><strong>Pseudo :</strong> {{ $user->pseudo }}</p>
        <p><strong>Email :</strong> {{ $user->email }}</p>
        <p><strong>Date de naissance :</strong> {{ $user->date_naissance ? $user->date_naissance->format('d/m/Y') :" - " }}</p>
        <p><strong>Rôle :</strong> {{ ucfirst($user->role) === "Admin" ? "Administrateur" : "Utilisateur" }}</p>

        <div class="mt-4">
            <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-blue-500 text-white py-2 px-4 rounded">Modifier</a>

            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block ml-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded">Supprimer</button>
            </form>
        </div>
    </div>
@endsection