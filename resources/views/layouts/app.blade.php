<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#080b12">
    <meta name="description" content="Discover your next favorite game. Browse popular PC and console games, explore genres, and save your wishlist.">
    <title>@yield('title', 'GameVault — Discover your next favorite game')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-gray-950 text-gray-100 antialiased">
    <header class="sticky top-0 z-40 border-b border-white/10 bg-gray-950/90 backdrop-blur-xl">
        <nav class="mx-auto flex max-w-7xl items-center justify-between gap-5 px-5 py-4 sm:px-8" aria-label="Main navigation">
            <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-3" aria-label="GameVault home">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-500 text-white shadow-lg shadow-indigo-500/20">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M7.5 8.5h9a4 4 0 0 1 3.88 3.03l.77 3.09a2.5 2.5 0 0 1-4.12 2.46l-1.6-1.43H8.57l-1.6 1.43a2.5 2.5 0 0 1-4.12-2.46l.77-3.09A4 4 0 0 1 7.5 8.5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                        <path d="M8 11v4m-2-2h4m5-1h.01M17 14h.01" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>
                </span>
                <span class="text-lg font-black tracking-tight text-white">GAME<span class="text-indigo-400">VAULT</span></span>
            </a>

            <div class="hidden items-center gap-8 text-sm font-medium text-gray-400 md:flex">
                <a href="#games" class="transition hover:text-white">Discover</a>
                <a href="#reviews" class="transition hover:text-white">Top rated</a>
                <a href="#upcoming" class="transition hover:text-white">Coming soon</a>
            </div>

            <livewire:search-dropdown />
        </nav>
        <div class="border-t border-white/5 px-5 py-2.5 md:hidden">
            <div class="mx-auto flex max-w-7xl gap-6 overflow-x-auto text-sm font-medium text-gray-400">
                <a href="#games" class="shrink-0 hover:text-white">Discover</a>
                <a href="#reviews" class="shrink-0 hover:text-white">Top rated</a>
                <a href="#upcoming" class="shrink-0 hover:text-white">Coming soon</a>
            </div>
        </div>
    </header>

    <main id="top">
        @yield('content')
    </main>

    <footer class="mt-20 border-t border-white/10">
        <div class="mx-auto flex max-w-7xl flex-col gap-4 px-5 py-8 text-sm text-gray-500 sm:flex-row sm:items-center sm:justify-between sm:px-8">
            <a href="{{ route('home') }}" class="font-black tracking-tight text-gray-300">GAME<span class="text-indigo-400">VAULT</span></a>
            <p>Find your next favorite game.</p>
            <a href="#top" class="transition hover:text-white">Back to top ↑</a>
        </div>
    </footer>
    @livewireScripts
</body>
</html>
