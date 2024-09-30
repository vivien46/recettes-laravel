@extends('layouts.app')

@section('title', 'Mot de passe oublié')

@section('content')
    <div class="flex justify-center items-center h-34 w-full">
        <div class="w-full bg-white shadow-md rounded-lg p-8">
            <h2 class="text-2xl font-bold mb-4">Mot de passe oublié</h2>
            @if (session('success'))
                <div class="bg-green-500 text-white p-3 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-500 text-white p-3 mb-4 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <p class="mb-4">Veuillez saisir votre adresse e-mail pour recevoir un lien de réinitialisation de mot de passe.</p>
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                    <input type="email" name="email" id="email" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500" required>
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Envoyer le lien de réinitialisation du mot de passe</button>
                </div>
            </form>
        </div>
    </div>
@endsection