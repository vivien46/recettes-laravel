@extends('layouts.app')

@section('title', 'Contact')

@section('main-spacing', 'pb-32')

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow">

        <h1 class="text-3xl font-bold text-gray-800 mb-6">
            Contact
        </h1>

        <p class="text-gray-700 mb-8">
            Pour toute question, tu peux nous contacter via le formulaire ci-dessous.
        </p>

        <form method="POST" action="#" class="space-y-6">
            @csrf

            <div>
                <label class="block text-gray-700 mb-1">Nom *</label>
                <input type="text"
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200">
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Email</label>
                <input type="email"
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200">
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Message</label>
                <textarea rows="5"
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"></textarea>
            </div>

            <div class="text-center pt-4">
                <button type="submit" class="bg-blue-600 text-white px-8 py-2 rounded hover:bg-blue-700 transition">
                    Envoyer
                </button>
            </div>
        </form>

        <hr class="my-10">

        <h2 class="text-xl font-semibold text-gray-800 mb-4">
            Autres moyens de contact
        </h2>

        <p class="text-gray-700">
            Email :
            <a href="mailto:contact@example.com" class="text-blue-600 hover:underline">
                contact@example.com
            </a>
        </p>
        <p class="text-gray-700">
            Téléphone : <strong>+33 1 23 45 67 89</strong>
        </p>
        <p class="text-gray-700">
            Nos reseaux sociaux :
            <a href="#" class="text-blue-600 hover:underline">Twitter</a>,
            <a href="#" class="text-blue-600 hover:underline">Facebook</a>
            et <a href="#" class="text-blue-600 hover:underline">LinkedIn</a>.
        </p>

    </div>
@endsection
