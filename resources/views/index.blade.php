@extends('layouts.app')

@section('content')
    @php
        $featuredGame = $games->first();
    @endphp

    <div class="mx-auto max-w-7xl px-5 pb-16 pt-8 sm:px-8 sm:pt-12">
        <section class="hero-panel relative isolate overflow-hidden rounded-3xl border border-white/10 bg-gray-900">
            @if ($featuredGame && $featuredGame['cover_url'])
                <img src="{{ $featuredGame['cover_url'] }}" alt="" class="hero-art absolute inset-0 -z-20 h-full w-full object-cover object-center">
            @endif
            <div class="absolute inset-0 -z-10 bg-gradient-to-r from-gray-950 via-gray-950/90 to-gray-950/20"></div>
            <div class="absolute inset-0 -z-10 bg-gradient-to-t from-gray-950/70 via-transparent to-gray-950/10"></div>

            <div class="max-w-2xl px-6 py-14 sm:px-12 sm:py-20 lg:py-24">
                <span class="inline-flex items-center gap-2 rounded-full border border-indigo-300/20 bg-indigo-400/10 px-3 py-1.5 text-xs font-bold uppercase tracking-[0.18em] text-indigo-200">
                    <span class="h-1.5 w-1.5 rounded-full bg-indigo-300"></span>
                    Powered by IGDB
                </span>
                <h1 class="mt-6 text-4xl font-black leading-tight tracking-tight text-white sm:text-6xl">
                    Find the game<br class="hidden sm:block"> you’ll <span class="text-indigo-300">love next.</span>
                </h1>
                <p class="mt-5 max-w-lg text-base leading-7 text-gray-300 sm:text-lg">
                    Explore popular games, discover new genres, and find your next favorite adventure.
                </p>
                <div class="mt-8 flex flex-wrap items-center gap-3">
                    <a href="#games" class="inline-flex items-center gap-2 rounded-xl bg-indigo-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-950/40 transition hover:bg-indigo-400">
                        Explore games
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="#upcoming" class="rounded-xl border border-white/15 bg-white/5 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10">See what’s next</a>
                </div>
            </div>
            @if ($featuredGame)
                <div class="absolute bottom-6 right-6 hidden rounded-xl border border-white/10 bg-gray-950/70 px-4 py-3 backdrop-blur sm:block">
                    <p class="text-xs font-semibold uppercase tracking-widest text-gray-400">Featured game</p>
                    <p class="mt-1 font-bold text-white">{{ $featuredGame['name'] }}</p>
                </div>
            @endif
        </section>

        <section id="games" class="scroll-mt-28 pt-16 sm:pt-20">
            @if (! $igdbConfigured)
                <p role="alert" class="mb-6 rounded-xl border border-amber-300/20 bg-amber-300/10 px-4 py-3 text-sm text-amber-100">
                    Add TWITCH_CLIENT_ID and TWITCH_CLIENT_SECRET to your .env file, then run php artisan config:clear to load games from IGDB.
                </p>
            @endif

            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-300">The collection</p>
                    <h2 class="mt-2 text-3xl font-black tracking-tight text-white sm:text-4xl">Popular games</h2>
                    <p class="mt-2 text-sm text-gray-400">Highly rated games fetched from IGDB.</p>
                </div>
                <label class="relative block w-full lg:max-w-sm">
                    <span class="sr-only">Filter loaded games</span>
                    <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-500" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="m20 20-4.5-4.5m2-5.5a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>
                    <input
                        type="search"
                        data-game-search
                        placeholder="Filter loaded games..."
                        class="w-full rounded-xl border border-white/10 bg-gray-900 py-3 pl-12 pr-4 text-sm text-white outline-none transition placeholder:text-gray-500 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/20"
                    >
                </label>
            </div>

            <div class="mt-7 flex flex-wrap gap-2" aria-label="Filter games by genre">
                <button type="button" data-filter="all" aria-pressed="true" class="filter-chip rounded-full border border-indigo-400 bg-indigo-500/15 px-4 py-2 text-sm font-semibold text-white transition">All games</button>
                <button type="button" data-filter="action" aria-pressed="false" class="filter-chip rounded-full border border-white/10 bg-gray-900 px-4 py-2 text-sm font-semibold text-gray-400 transition hover:border-white/20 hover:text-white">Action</button>
                <button type="button" data-filter="rpg" aria-pressed="false" class="filter-chip rounded-full border border-white/10 bg-gray-900 px-4 py-2 text-sm font-semibold text-gray-400 transition hover:border-white/20 hover:text-white">RPG</button>
                <button type="button" data-filter="adventure" aria-pressed="false" class="filter-chip rounded-full border border-white/10 bg-gray-900 px-4 py-2 text-sm font-semibold text-gray-400 transition hover:border-white/20 hover:text-white">Adventure</button>
                <button type="button" data-filter="indie" aria-pressed="false" class="filter-chip rounded-full border border-white/10 bg-gray-900 px-4 py-2 text-sm font-semibold text-gray-400 transition hover:border-white/20 hover:text-white">Indie</button>
                <button type="button" data-filter="saved" aria-pressed="false" class="filter-chip inline-flex items-center gap-2 rounded-full border border-white/10 bg-gray-900 px-4 py-2 text-sm font-semibold text-gray-400 transition hover:border-white/20 hover:text-white">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 4.75A1.75 1.75 0 0 1 7.75 3h8.5A1.75 1.75 0 0 1 18 4.75V21l-6-4-6 4V4.75Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>
                    Watchlist <span data-watchlist-count class="rounded-full bg-white/10 px-1.5 py-0.5 text-xs">0</span>
                </button>
            </div>

            <div class="mt-4 flex items-center justify-between text-xs text-gray-500">
                <p data-results-count aria-live="polite">Showing {{ $games->count() }} games</p>
                <p>IGDB ratings shown out of 10</p>
            </div>

            <div data-game-grid class="mt-5 grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-5 lg:grid-cols-4 xl:gap-x-6">
                @foreach ($games as $game)
                    @php
                        $searchableText = mb_strtolower(implode(' ', [$game['name'], ...$game['genres'], ...$game['platforms']]));
                    @endphp
                    <article
                        wire:key="game-{{ $game['id'] }}"
                        data-game-card
                        data-genres="{{ implode(' ', $game['genre_slugs']) }}"
                        data-search="{{ $searchableText }}"
                        class="game-card group min-w-0"
                    >
                        <div class="game-cover relative aspect-[3/4] overflow-hidden rounded-xl bg-gradient-to-br from-indigo-950 to-gray-900">
                            @if ($game['cover_url'])
                                <img src="{{ $game['cover_url'] }}" alt="{{ $game['name'] }} cover art" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                            @else
                                <div class="flex h-full items-center justify-center px-4 text-center text-sm font-semibold text-gray-500">Cover art unavailable</div>
                            @endif
                            <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-gray-950/90 to-transparent"></div>
                            @if ($game['rating'])
                                <span class="absolute bottom-3 left-3 inline-flex items-center gap-1.5 rounded-lg bg-gray-950/80 px-2.5 py-1.5 text-xs font-bold text-emerald-300 backdrop-blur"><span aria-hidden="true">★</span> {{ $game['rating'] }}</span>
                            @endif
                            <button type="button" data-save-game aria-pressed="false" aria-label="Add {{ $game['name'] }} to watchlist" class="absolute right-3 top-3 flex h-9 w-9 items-center justify-center rounded-full border border-white/15 bg-gray-950/70 text-white backdrop-blur transition hover:bg-indigo-500">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m12 20-1.35-1.23C5.85 14.4 3 11.82 3 8.65 3 6.07 5.02 4 7.6 4c1.46 0 2.86.68 3.8 1.75A5.1 5.1 0 0 1 15.2 4C17.78 4 19.8 6.07 19.8 8.65c0 3.17-2.85 5.75-7.65 10.13L12 20Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>
                            </button>
                        </div>
                        <div class="pt-3">
                            <div class="flex items-start justify-between gap-2">
                                <h3 class="font-bold leading-snug text-white transition group-hover:text-indigo-300"><a href="{{ $game['url'] }}" target="_blank" rel="noopener noreferrer">{{ $game['name'] }}</a></h3>
                                @if ($game['year'])
                                    <span class="shrink-0 text-xs text-gray-500">{{ $game['year'] }}</span>
                                @endif
                            </div>
                            @if ($game['platforms'] !== [])
                                <p class="mt-1 truncate text-xs text-gray-500">{{ implode(' · ', $game['platforms']) }}</p>
                            @endif
                            @if ($game['genres'] !== [])
                                <div class="mt-3 flex flex-wrap gap-1.5">
                                    @foreach (array_slice($game['genres'], 0, 3) as $genre)
                                        <span class="rounded-md bg-white/5 px-2 py-1 text-[11px] text-gray-400">{{ $genre }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>

            <div data-empty-state @if ($games->isNotEmpty()) hidden @endif class="mt-8 rounded-2xl border border-dashed border-white/10 bg-gray-900/50 px-6 py-12 text-center">
                <p class="text-lg font-bold text-white">No games found</p>
                <p class="mt-2 text-sm text-gray-400">Try another title, genre, or add a game to your watchlist.</p>
            </div>
        </section>

        <section id="reviews" class="scroll-mt-28 pt-20">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-300">From the IGDB catalog</p>
                    <h2 class="mt-2 text-3xl font-black tracking-tight text-white">Top-rated adventures</h2>
                </div>
                <p class="max-w-md text-sm leading-6 text-gray-400">Game ratings and details are provided by IGDB.</p>
            </div>
            <div class="mt-7 grid gap-4 md:grid-cols-3">
                @foreach ($games->take(3) as $game)
                    <article class="rounded-2xl border border-white/10 bg-gray-900/70 p-5">
                        <div class="flex items-center justify-between gap-3">
                            <span class="truncate text-xs font-semibold uppercase tracking-widest text-gray-500">{{ $game['genres'][0] ?? 'Game' }}</span>
                            @if ($game['rating'])
                                <span class="shrink-0 text-sm font-bold text-emerald-300">{{ $game['rating'] }} <span class="text-gray-500">/ 10</span></span>
                            @endif
                        </div>
                        <h3 class="mt-4 text-lg font-bold text-white">{{ $game['name'] }}</h3>
                        <p class="mt-2 text-sm leading-6 text-gray-400">Discover more about this game in the IGDB catalog.</p>
                    </article>
                @endforeach
            </div>
        </section>

        <section id="upcoming" class="scroll-mt-28 pt-20">
            <div class="rounded-3xl border border-indigo-300/10 bg-gradient-to-br from-indigo-950/60 via-gray-900 to-gray-900 p-6 sm:p-9">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div class="max-w-xl">
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-300">Keep an eye out</p>
                        <h2 class="mt-2 text-3xl font-black tracking-tight text-white">More worlds on the horizon.</h2>
                        <p class="mt-3 text-sm leading-6 text-gray-400">Release timing can change, so check with the publisher for the latest details.</p>
                    </div>
                    <div class="grid gap-3 sm:grid-cols-3 lg:min-w-[52%]">
                        <div class="rounded-xl border border-white/10 bg-gray-950/40 p-4"><span class="text-xs font-semibold uppercase tracking-wider text-indigo-300">Fantasy RPG</span><h3 class="mt-2 font-bold text-white">The Witcher IV</h3><p class="mt-1 text-xs text-gray-500">Release date TBA</p></div>
                        <div class="rounded-xl border border-white/10 bg-gray-950/40 p-4"><span class="text-xs font-semibold uppercase tracking-wider text-indigo-300">Adventure</span><h3 class="mt-2 font-bold text-white">Fable</h3><p class="mt-1 text-xs text-gray-500">Release date TBA</p></div>
                        <div class="rounded-xl border border-white/10 bg-gray-950/40 p-4"><span class="text-xs font-semibold uppercase tracking-wider text-indigo-300">Action</span><h3 class="mt-2 font-bold text-white">Marvel’s Wolverine</h3><p class="mt-1 text-xs text-gray-500">Release date TBA</p></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
