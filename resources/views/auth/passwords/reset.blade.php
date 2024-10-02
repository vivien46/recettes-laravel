@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Réinitialiser le mot de passe</h2>

        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Adresse e-mail</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-300 p-2 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Nouveau mot de passe</label>
                <input type="password" id="password" name="password" class="w-full border border-gray-300 p-2 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700">Confirmer le mot de passe</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full border border-gray-300 p-2 rounded-lg" required>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 transition-colors">Réinitialiser le mot de passe</button>
        </form>
    </div>
@endsection