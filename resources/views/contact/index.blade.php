@extends('layouts.app')

@section('title', 'Contact')

@section('main-spacing', 'pb-32')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 text-gray-200">
    <h1 class="text-3xl font-bold mb-6">Contact</h1>

    <p class="mb-6">
        Pour toute question, tu peux nous contacter via le formulaire ci-dessous.
    </p>

    <form method="POST" action="#" class="mb-6 p-6 rounded shadow-md border border-gray-600 flex flex-col justify-center items-center ">
        @csrf
        
        <input type="text" placeholder="Nom"
               class="w-full mb-4 p-2 rounded bg-gray-800 border border-gray-600">
        <span class="text-red-500 mb-4 self-start"><small>* Ce champ est requis.</small></span>
        <input type="email" placeholder="Email"
               class="w-full mb-4 p-2 rounded bg-gray-800 border border-gray-600">

        <textarea placeholder="Message"
                  class="w-full mb-4 p-2 rounded bg-gray-800 border border-gray-600"></textarea>

        <button class="bg-blue-500 hover:bg-blue-600 px-6 py-2 rounded">
            Envoyer
        </button>
        
    </form>
</div>

<div class="max-w-4xl mx-auto py-12 px-4 text-gray-200">
    <h2 class="text-2xl font-bold mb-6">Autres moyens de nous contacter</h2>

    <p class="mb-4">
        Tu peux également nous joindre via les moyens suivants :
    </p>

    <ul class="list-disc list-inside mb-4">
        <li>Email : <a href="mailto:contact@example.com">contact@example.com</a></li>
    </ul>
</div>

<p class="max-w-4xl mx-auto py-12 px-4 text-gray-200"> 
    Nous nous engageons à répondre à toutes les demandes dans les plus brefs délais. Merci de ton intérêt pour notre site !
</p>
<div class="max-w-4xl mx-auto py-12 px-4 text-gray-200">
    <h2 class="text-2xl font-bold mb-6">Suivez-nous sur les réseaux sociaux</h2>

    <p class="mb-4">
        Restez connecté avec nous via nos plateformes sociales :
    </p>

    <ul class="list-disc list-inside mb-4">
        <li><a href="https://www.facebook.com/yourpage" target="_blank" class="text-blue-400 hover:underline">Facebook</a></li>
        <li><a href="https://www.twitter.com/yourprofile" target="_blank" class="text-blue-400 hover:underline">Twitter</a></li>
        <li><a href="https://www.instagram.com/yourprofile" target="_blank" class="text-blue-400 hover:underline">Instagram</a></li>
        <li><a href="https://www.linkedin.com/yourprofile" target="_blank" class="text-blue-400 hover:underline">LinkedIn</a></li>
    </ul>
</div>
@endsection