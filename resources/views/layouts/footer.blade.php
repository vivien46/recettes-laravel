<footer class="bg-gray-800 text-white p-4 mt-auto w-full">
    <div class="container mx-auto flex flex-col md:flex-col justify-between items-center md:text-center">
        <div class="flex flex-wrap justify-center md:justify-end space-x-4">
            <a href="{{ route('mentions-legales') }}" class="hover:text-blue-400  text-semibold">Mentions Légales</a>
            <a href="{{ route('politique-confidentialite') }}" class="hover:text-blue-400  text-semibold">Politique de Confidentialité</a>
            <a href="{{ route('contact') }}" class="hover:text-blue-400  text-semibold">Contact</a>
        </div>
        <p class="text-semibold">
            &copy; 2024{{ now()->year > 2024 ? ' - ' . now()->year : '' }}
            - <span class="font-bold text-blue-400 uppercase">{{ config('app.name') }}</span>. Tous droits réservés.
        </p>
    </div>
</footer>
