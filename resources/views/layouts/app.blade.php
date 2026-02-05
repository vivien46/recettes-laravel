<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mon site Laravel')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex flex-col min-h-screen min-w-min">

    <!-- Inclure la barre de navigation -->
    @include('layouts.navbar')

    <div class="parallax-header">
    </div>

    <!-- Contenu principal -->
    <main class="container mx-auto pt-12 pb-16 flex-grow @yield('main-spacing', 'pb-16')">
        @yield('content')
    </main>
    @include('layouts.footer')
    @vite('resources/js/app.js')
</body>

</html>
