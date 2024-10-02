@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-lg shadow-md text-center">
        <h2 class="text-2xl font-bold mb-4">Vérifiez votre e-mail</h2>
        <p class="mb-4">Nous vous avons envoyé un e-mail de vérification. Veuillez cliquer sur le lien pour vérifier votre compte.</p>

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Renvoyer l'e-mail de vérification
            </button>
        </form>
    </div>
@endsection