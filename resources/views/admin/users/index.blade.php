@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold text-center">Gestion des utilisateurs</h1>


<div class="m-5">
    {{ $users->links() }}
</div>

<div class="flex justify-end mt-4">
    <a href="{{ route('admin.users.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Ajouter un utilisateur</a>
</div>
<table class="min-w-full bg-white shadow-md rounded-lg mt-4">
    <thead>
        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
            <th class="py-3 px-6 text-center">Nom</th>
            <th class="py-3 px-6 text-center">Prenom</th>
            <th class="py-3 px-6 text-center">Date de naissance</th>
            <th class="py-3 px-6 text-center">Email</th>
            <th class="py-3 px-6 text-center">Rôle</th>
            <th class="py-3 px-6 text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr class="border-b border-gray-200 bg-gray-50 hover:bg-gray-100">
            <td class="py-3 px-6 text-center">{{ strtoupper($user->nom) }}</td>
            <td class="py-3 px-6 text-center">{{ ucfirst($user->prenom) }}</td>
            <td class="py-3 px-6 text-center">{{ $user->date_naissance ? $user->date_naissance->format('d/m/Y') :"Non renseignée" }}</td>
            <td class="py-3 px-6 text-center">{{ $user->email }}</td>
            <td class="py-3 px-6 text-center">
            <div class="flex justify-center items-center text-sm md:text-base whitespace-nowrap">
                {!! ucfirst($user->role) === "Admin" ? "Administrateur <i class='fa-solid fa-crown text-yellow-400 ml-2'></i>" : "Utilisateur" !!}
            </td>


            <td class="py-4 text-center">
                <a href="{{ route('admin.users.show', $user->id) }}"><i class="fas fa-eye text-green-500"></i></a>
                <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-500 hover:underline ml-2"><i class="fas fa-edit"></i></a>
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block ml-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500"><i class="fas fa-trash hover:underline"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="m-5">
    {{ $users->links() }}
</div>
@endsection
