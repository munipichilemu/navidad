<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="application-name" content="{{ config('app.name') }} {{ config('app.year') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} {{ config('app.year') }}</title>

    <style>
        [x-cloak] { display: none !important; }
    </style>

    @filamentStyles
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen text-white flex flex-col">
    {{-- Navbar flotante --}}
    <nav class="fixed top-0 left-0 right-0 bg-gradient-to-b from-sky-950/50 to-transparent z-50">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="flex items-center text-white">
                        <img class="h-8" src="{{ Vite::asset('resources/images/logo.svg') }}" alt="{{ config('app.name') }} {{ config('app.year') }}">
                        <span class="ml-2 text-xl font-bold">{{ config('app.name') }} {{ config('app.year') }}</span>
                    </a>
                </div>

                <div class="flex items-center space-x-8">
                    <a href="{{ route('inscribir') }}" class="bg-transparent border border-white/80 text-white px-4 py-2 rounded-lg hover:bg-emerald-600/80 hover:border-transparent transition flex items-center">
                        <x-fas-gift class="h-5 mr-1" />
                        <span>Inscribir</span>
                    </a>

                    <a href="/admin" class="text-white/70 hover:text-white transition" title="Panel de administración">
                        <x-fas-arrow-right-to-bracket class="h-5" />
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Contenido principal centrado --}}
    <main class="flex-grow flex items-center justify-center mt-16">
        <div class="w-full">
            {{ $slot }}
        </div>
    </main>

    {{-- Footer --}}
    <footer class="py-4 pt-8 mt-auto bg-gradient-to-b from-transparent to-sky-950/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm text-gray-200">
                Desarrollado por la Oficina de Computación e Informática – Municipalidad de Pichilemu
            </p>
        </div>
    </footer>

    @livewire('notifications')
    @filamentScripts
    @vite('resources/js/app.js')
</body>
</html>
