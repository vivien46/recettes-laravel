@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Modifier l'utilisateur : {{$user->prenom}} {{ $user->nom }}</h1>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 message-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="mb-5">
        @method('PUT')
        @include('admin.users._form')
        <button class="bg-blue-500 text-white py-2 px-4 rounded">Mettre à jour</button>
    </form>
@endsection
