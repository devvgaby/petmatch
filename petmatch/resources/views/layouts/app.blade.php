<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light d-flex flex-column min-vh-100">
    <header class="py-3 bg-white shadow-sm">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" alt="PetMatch" width="40">
                <h5 class="mb-0">PetMatch</h5>
            </div>
            <span class="text-muted">Conectando Pets e Tutores</span>
        </div>
    </header>
    <main class="flex-grow-1 d-flex align-items-center justify-content-center">
        @yield('content')
    </main>
    <footer class="bg-white py-3 mt-auto border-top">
        <div class="container text-center text-muted">
            © 2025 PetMatch - Projeto Acadêmico
        </div>
    </footer>
</body>
</html>