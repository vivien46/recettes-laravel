@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-4">Créer un utilisateur</h1>

<form action="{{ route('admin.users.store') }}" method="POST">
    @include('admin.users._form')
    <button class="bg-blue-500 text-white py-2 px-4 rounded">Créer</button>
    </form>
@endsection