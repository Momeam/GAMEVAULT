@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-7xl px-5 pb-16 pt-8 sm:px-8 sm:pt-12">
        <section class="hero-panel relative isolate overflow-hidden rounded-3xl border border-white/10 bg-gray-900">
            <img
                src="https://cdn.akamai.steamstatic.com/steam/apps/1091500/header.jpg"
                alt=""
                class="hero-art absolute inset-0 -z-20 h-full w-full object-cover object-center"
            >
            <div class="absolute inset-0 -z-10 bg-gradient-to-r from-gray-950 via-gray-950/90 to-gray-950/20"></div>
            <div class="absolute inset-0 -z-10 bg-gradient-to-t from-gray-950/70 via-transparent to-gray-950/10"></div>

            <div class="max-w-2xl px-6 py-14 sm:px-12 sm:py-20 lg:py-24">
                <span class="inline-flex items-center gap-2 rounded-full border border-indigo-300/20 bg-indigo-400/10 px-3 py-1.5 text-xs font-bold uppercase tracking-[0.18em] text-indigo-200">
                    <span class="h-1.5 w-1.5 rounded-full bg-indigo-300"></span>
                    Your next adventure starts here
                </span>
                <h1 class="mt-6 text-4xl font-black leading-tight tracking-tight text-white sm:text-6xl">
                    Find the game<br class="hidden sm:block"> you’ll <span class="text-indigo-300">love next.</span>
                </h1>
                <p class="mt-5 max-w-lg text-base leading-7 text-gray-300 sm:text-lg">
                    A hand-picked collection of standout games across PC and console. Explore, compare, and keep your next favorite close.
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
                <div class="mt-10 flex items-center gap-3 text-sm text-gray-400">
                    <div class="flex -space-x-2" aria-hidden="true">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-gray-900 bg-rose-400 text-xs font-bold text-gray-950">G</span>
                        <span class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-gray-900 bg-amber-300 text-xs font-bold text-gray-950">+</span>
                        <span class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-gray-900 bg-cyan-300 text-xs font-bold text-gray-950">V</span>
                    </div>
                    <span>A better place to find your next favorite</span>
                </div>
            </div>
            <div class="absolute bottom-6 right-6 hidden rounded-xl border border-white/10 bg-gray-950/70 px-4 py-3 backdrop-blur sm:block">
                <p class="text-xs font-semibold uppercase tracking-widest text-gray-400">Featured game</p>
                <p class="mt-1 font-bold text-white">Cyberpunk 2077</p>
            </div>
        </section>

        <section id="games" class="scroll-mt-28 pt-16 sm:pt-20">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-300">The collection</p>
                    <h2 class="mt-2 text-3xl font-black tracking-tight text-white sm:text-4xl">Popular games</h2>
                    <p class="mt-2 text-sm text-gray-400">Big adventures, unforgettable worlds, and a few hidden gems.</p>
                </div>
                <label class="relative block w-full lg:max-w-sm">
                    <span class="sr-only">Search games</span>
                    <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-500" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="m20 20-4.5-4.5m2-5.5a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>
                    <input
                        type="search"
                        data-game-search
                        placeholder="Search by title or genre..."
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
                <p data-results-count aria-live="polite">Showing 9 games</p>
                <p>Updated for curious players</p>
            </div>

            <div data-game-grid class="mt-5 grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-5 lg:grid-cols-4 xl:gap-x-6">
                <article data-game-card data-genres="rpg action" data-search="cyberpunk 2077 rpg action open world sci-fi pc playstation xbox" class="game-card group min-w-0">
                    <div class="game-cover relative aspect-[3/4] overflow-hidden rounded-xl bg-gradient-to-br from-fuchsia-950 to-gray-900">
                        <img src="https://cdn.akamai.steamstatic.com/steam/apps/1091500/library_600x900_2x.jpg" alt="Cyberpunk 2077 cover art" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-gray-950/90 to-transparent"></div>
                        <span class="absolute left-3 top-3 rounded-full border border-white/10 bg-gray-950/70 px-2.5 py-1 text-[11px] font-semibold text-gray-100 backdrop-blur">Editor's pick</span>
                        <span class="absolute bottom-3 left-3 inline-flex items-center gap-1.5 rounded-lg bg-gray-950/80 px-2.5 py-1.5 text-xs font-bold text-emerald-300 backdrop-blur"><span aria-hidden="true">★</span> 9.2</span>
                        <button type="button" data-save-game aria-pressed="false" aria-label="Add Cyberpunk 2077 to watchlist" class="absolute right-3 top-3 flex h-9 w-9 items-center justify-center rounded-full border border-white/15 bg-gray-950/70 text-white backdrop-blur transition hover:bg-indigo-500">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m12 20-1.35-1.23C5.85 14.4 3 11.82 3 8.65 3 6.07 5.02 4 7.6 4c1.46 0 2.86.68 3.8 1.75A5.1 5.1 0 0 1 15.2 4C17.78 4 19.8 6.07 19.8 8.65c0 3.17-2.85 5.75-7.65 10.13L12 20Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>
                        </button>
                    </div>
                    <div class="pt-3">
                        <div class="flex items-start justify-between gap-2">
                            <h3 class="font-bold leading-snug text-white transition group-hover:text-indigo-300"><a href="https://store.steampowered.com/app/1091500/" target="_blank" rel="noopener noreferrer">Cyberpunk 2077</a></h3>
                            <span class="shrink-0 text-xs text-gray-500">2020</span>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">PC · PlayStation · Xbox</p>
                        <div class="mt-3 flex flex-wrap gap-1.5"><span class="rounded-md bg-white/5 px-2 py-1 text-[11px] text-gray-400">RPG</span><span class="rounded-md bg-white/5 px-2 py-1 text-[11px] text-gray-400">Open world</span></div>
                    </div>
                </article>

                <article data-game-card data-genres="rpg action adventure" data-search="elden ring rpg action adventure fantasy pc playstation xbox" class="game-card group min-w-0">
                    <div class="game-cover relative aspect-[3/4] overflow-hidden rounded-xl bg-gradient-to-br from-amber-950 to-gray-900">
                        <img src="https://cdn.akamai.steamstatic.com/steam/apps/1245620/library_600x900_2x.jpg" alt="Elden Ring cover art" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-gray-950/90 to-transparent"></div>
                        <span class="absolute bottom-3 left-3 inline-flex items-center gap-1.5 rounded-lg bg-gray-950/80 px-2.5 py-1.5 text-xs font-bold text-emerald-300 backdrop-blur"><span aria-hidden="true">★</span> 9.5</span>
                        <button type="button" data-save-game aria-pressed="false" aria-label="Add Elden Ring to watchlist" class="absolute right-3 top-3 flex h-9 w-9 items-center justify-center rounded-full border border-white/15 bg-gray-950/70 text-white backdrop-blur transition hover:bg-indigo-500"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m12 20-1.35-1.23C5.85 14.4 3 11.82 3 8.65 3 6.07 5.02 4 7.6 4c1.46 0 2.86.68 3.8 1.75A5.1 5.1 0 0 1 15.2 4C17.78 4 19.8 6.07 19.8 8.65c0 3.17-2.85 5.75-7.65 10.13L12 20Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg></button>
                    </div>
                    <div class="pt-3"><div class="flex items-start justify-between gap-2"><h3 class="font-bold leading-snug text-white transition group-hover:text-indigo-300"><a href="https://store.steampowered.com/app/1245620/" target="_blank" rel="noopener noreferrer">Elden Ring</a></h3><span class="shrink-0 text-xs text-gray-500">2022</span></div><p class="mt-1 text-xs text-gray-500">PC · PlayStation · Xbox</p><div class="mt-3 flex flex-wrap gap-1.5"><span class="rounded-md bg-white/5 px-2 py-1 text-[11px] text-gray-400">RPG</span><span class="rounded-md bg-white/5 px-2 py-1 text-[11px] text-gray-400">Fantasy</span></div></div>
                </article>

                <article data-game-card data-genres="rpg adventure" data-search="baldurs gate 3 baldurs gate iii rpg adventure fantasy pc playstation xbox" class="game-card group min-w-0">
                    <div class="game-cover relative aspect-[3/4] overflow-hidden rounded-xl bg-gradient-to-br from-violet-950 to-gray-900">
                        <img src="https://cdn.akamai.steamstatic.com/steam/apps/1086940/library_600x900_2x.jpg" alt="Baldur's Gate 3 cover art" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-gray-950/90 to-transparent"></div>
                        <span class="absolute bottom-3 left-3 inline-flex items-center gap-1.5 rounded-lg bg-gray-950/80 px-2.5 py-1.5 text-xs font-bold text-emerald-300 backdrop-blur"><span aria-hidden="true">★</span> 9.6</span>
                        <button type="button" data-save-game aria-pressed="false" aria-label="Add Baldur's Gate 3 to watchlist" class="absolute right-3 top-3 flex h-9 w-9 items-center justify-center rounded-full border border-white/15 bg-gray-950/70 text-white backdrop-blur transition hover:bg-indigo-500"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m12 20-1.35-1.23C5.85 14.4 3 11.82 3 8.65 3 6.07 5.02 4 7.6 4c1.46 0 2.86.68 3.8 1.75A5.1 5.1 0 0 1 15.2 4C17.78 4 19.8 6.07 19.8 8.65c0 3.17-2.85 5.75-7.65 10.13L12 20Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg></button>
                    </div>
                    <div class="pt-3"><div class="flex items-start justify-between gap-2"><h3 class="font-bold leading-snug text-white transition group-hover:text-indigo-300"><a href="https://store.steampowered.com/app/1086940/" target="_blank" rel="noopener noreferrer">Baldur’s Gate 3</a></h3><span class="shrink-0 text-xs text-gray-500">2023</span></div><p class="mt-1 text-xs text-gray-500">PC · PlayStation · Xbox</p><div class="mt-3 flex flex-wrap gap-1.5"><span class="rounded-md bg-white/5 px-2 py-1 text-[11px] text-gray-400">RPG</span><span class="rounded-md bg-white/5 px-2 py-1 text-[11px] text-gray-400">Fantasy</span></div></div>
                </article>

                <article data-game-card data-genres="action adventure" data-search="red dead redemption 2 rdr2 action adventure western pc playstation xbox" class="game-card group min-w-0">
                    <div class="game-cover relative aspect-[3/4] overflow-hidden rounded-xl bg-gradient-to-br from-red-950 to-gray-900">
                        <img src="https://cdn.akamai.steamstatic.com/steam/apps/1174180/library_600x900_2x.jpg" alt="Red Dead Redemption 2 cover art" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-gray-950/90 to-transparent"></div>
                        <span class="absolute bottom-3 left-3 inline-flex items-center gap-1.5 rounded-lg bg-gray-950/80 px-2.5 py-1.5 text-xs font-bold text-emerald-300 backdrop-blur"><span aria-hidden="true">★</span> 9.7</span>
                        <button type="button" data-save-game aria-pressed="false" aria-label="Add Red Dead Redemption 2 to watchlist" class="absolute right-3 top-3 flex h-9 w-9 items-center justify-center rounded-full border border-white/15 bg-gray-950/70 text-white backdrop-blur transition hover:bg-indigo-500"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m12 20-1.35-1.23C5.85 14.4 3 11.82 3 8.65 3 6.07 5.02 4 7.6 4c1.46 0 2.86.68 3.8 1.75A5.1 5.1 0 0 1 15.2 4C17.78 4 19.8 6.07 19.8 8.65c0 3.17-2.85 5.75-7.65 10.13L12 20Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg></button>
                    </div>
                    <div class="pt-3"><div class="flex items-start justify-between gap-2"><h3 class="font-bold leading-snug text-white transition group-hover:text-indigo-300"><a href="https://store.steampowered.com/app/1174180/" target="_blank" rel="noopener noreferrer">Red Dead Redemption 2</a></h3><span class="shrink-0 text-xs text-gray-500">2018</span></div><p class="mt-1 text-xs text-gray-500">PC · PlayStation · Xbox</p><div class="mt-3 flex flex-wrap gap-1.5"><span class="rounded-md bg-white/5 px-2 py-1 text-[11px] text-gray-400">Action</span><span class="rounded-md bg-white/5 px-2 py-1 text-[11px] text-gray-400">Western</span></div></div>
                </article>

                <article data-game-card data-genres="indie adventure" data-search="stardew valley indie adventure farming pc playstation xbox switch" class="game-card group min-w-0">
                    <div class="game-cover relative aspect-[3/4] overflow-hidden rounded-xl bg-gradient-to-br from-green-950 to-gray-900">
                        <img src="https://cdn.akamai.steamstatic.com/steam/apps/413150/library_600x900_2x.jpg" alt="Stardew Valley cover art" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-gray-950/90 to-transparent"></div>
                        <span class="absolute bottom-3 left-3 inline-flex items-center gap-1.5 rounded-lg bg-gray-950/80 px-2.5 py-1.5 text-xs font-bold text-emerald-300 backdrop-blur"><span aria-hidden="true">★</span> 9.1</span>
                        <button type="button" data-save-game aria-pressed="false" aria-label="Add Stardew Valley to watchlist" class="absolute right-3 top-3 flex h-9 w-9 items-center justify-center rounded-full border border-white/15 bg-gray-950/70 text-white backdrop-blur transition hover:bg-indigo-500"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m12 20-1.35-1.23C5.85 14.4 3 11.82 3 8.65 3 6.07 5.02 4 7.6 4c1.46 0 2.86.68 3.8 1.75A5.1 5.1 0 0 1 15.2 4C17.78 4 19.8 6.07 19.8 8.65c0 3.17-2.85 5.75-7.65 10.13L12 20Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg></button>
                    </div>
                    <div class="pt-3"><div class="flex items-start justify-between gap-2"><h3 class="font-bold leading-snug text-white transition group-hover:text-indigo-300"><a href="https://store.steampowered.com/app/413150/" target="_blank" rel="noopener noreferrer">Stardew Valley</a></h3><span class="shrink-0 text-xs text-gray-500">2016</span></div><p class="mt-1 text-xs text-gray-500">PC · PlayStation · Xbox · Switch</p><div class="mt-3 flex flex-wrap gap-1.5"><span class="rounded-md bg-white/5 px-2 py-1 text-[11px] text-gray-400">Indie</span><span class="rounded-md bg-white/5 px-2 py-1 text-[11px] text-gray-400">Relaxing</span></div></div>
                </article>

                <article data-game-card data-genres="action indie" data-search="hades action indie roguelike mythology pc playstation xbox switch" class="game-card group min-w-0">
                    <div class="game-cover relative aspect-[3/4] overflow-hidden rounded-xl bg-gradient-to-br from-orange-950 to-gray-900">
                        <img src="https://cdn.akamai.steamstatic.com/steam/apps/1145360/library_600x900_2x.jpg" alt="Hades cover art" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-gray-950/90 to-transparent"></div>
                        <span class="absolute bottom-3 left-3 inline-flex items-center gap-1.5 rounded-lg bg-gray-950/80 px-2.5 py-1.5 text-xs font-bold text-emerald-300 backdrop-blur"><span aria-hidden="true">★</span> 9.3</span>
                        <button type="button" data-save-game aria-pressed="false" aria-label="Add Hades to watchlist" class="absolute right-3 top-3 flex h-9 w-9 items-center justify-center rounded-full border border-white/15 bg-gray-950/70 text-white backdrop-blur transition hover:bg-indigo-500"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m12 20-1.35-1.23C5.85 14.4 3 11.82 3 8.65 3 6.07 5.02 4 7.6 4c1.46 0 2.86.68 3.8 1.75A5.1 5.1 0 0 1 15.2 4C17.78 4 19.8 6.07 19.8 8.65c0 3.17-2.85 5.75-7.65 10.13L12 20Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg></button>
                    </div>
                    <div class="pt-3"><div class="flex items-start justify-between gap-2"><h3 class="font-bold leading-snug text-white transition group-hover:text-indigo-300"><a href="https://store.steampowered.com/app/1145360/" target="_blank" rel="noopener noreferrer">Hades</a></h3><span class="shrink-0 text-xs text-gray-500">2020</span></div><p class="mt-1 text-xs text-gray-500">PC · PlayStation · Xbox · Switch</p><div class="mt-3 flex flex-wrap gap-1.5"><span class="rounded-md bg-white/5 px-2 py-1 text-[11px] text-gray-400">Indie</span><span class="rounded-md bg-white/5 px-2 py-1 text-[11px] text-gray-400">Action</span></div></div>
                </article>

                <article data-game-card data-genres="action adventure" data-search="black myth wukong action adventure fantasy pc playstation" class="game-card group min-w-0">
                    <div class="game-cover relative aspect-[3/4] overflow-hidden rounded-xl bg-gradient-to-br from-yellow-950 to-gray-900">
                        <img src="https://cdn.akamai.steamstatic.com/steam/apps/2358720/library_600x900_2x.jpg" alt="Black Myth: Wukong cover art" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-gray-950/90 to-transparent"></div>
                        <span class="absolute bottom-3 left-3 inline-flex items-center gap-1.5 rounded-lg bg-gray-950/80 px-2.5 py-1.5 text-xs font-bold text-emerald-300 backdrop-blur"><span aria-hidden="true">★</span> 8.9</span>
                        <button type="button" data-save-game aria-pressed="false" aria-label="Add Black Myth: Wukong to watchlist" class="absolute right-3 top-3 flex h-9 w-9 items-center justify-center rounded-full border border-white/15 bg-gray-950/70 text-white backdrop-blur transition hover:bg-indigo-500"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m12 20-1.35-1.23C5.85 14.4 3 11.82 3 8.65 3 6.07 5.02 4 7.6 4c1.46 0 2.86.68 3.8 1.75A5.1 5.1 0 0 1 15.2 4C17.78 4 19.8 6.07 19.8 8.65c0 3.17-2.85 5.75-7.65 10.13L12 20Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg></button>
                    </div>
                    <div class="pt-3"><div class="flex items-start justify-between gap-2"><h3 class="font-bold leading-snug text-white transition group-hover:text-indigo-300"><a href="https://store.steampowered.com/app/2358720/" target="_blank" rel="noopener noreferrer">Black Myth: Wukong</a></h3><span class="shrink-0 text-xs text-gray-500">2024</span></div><p class="mt-1 text-xs text-gray-500">PC · PlayStation</p><div class="mt-3 flex flex-wrap gap-1.5"><span class="rounded-md bg-white/5 px-2 py-1 text-[11px] text-gray-400">Action</span><span class="rounded-md bg-white/5 px-2 py-1 text-[11px] text-gray-400">Fantasy</span></div></div>
                </article>

                <article data-game-card data-genres="rpg adventure" data-search="the witcher 3 wild hunt rpg adventure fantasy pc playstation xbox switch" class="game-card group min-w-0">
                    <div class="game-cover relative aspect-[3/4] overflow-hidden rounded-xl bg-gradient-to-br from-slate-700 to-gray-900">
                        <img src="https://cdn.akamai.steamstatic.com/steam/apps/292030/library_600x900_2x.jpg" alt="The Witcher 3: Wild Hunt cover art" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-gray-950/90 to-transparent"></div>
                        <span class="absolute bottom-3 left-3 inline-flex items-center gap-1.5 rounded-lg bg-gray-950/80 px-2.5 py-1.5 text-xs font-bold text-emerald-300 backdrop-blur"><span aria-hidden="true">★</span> 9.3</span>
                        <button type="button" data-save-game aria-pressed="false" aria-label="Add The Witcher 3 to watchlist" class="absolute right-3 top-3 flex h-9 w-9 items-center justify-center rounded-full border border-white/15 bg-gray-950/70 text-white backdrop-blur transition hover:bg-indigo-500"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m12 20-1.35-1.23C5.85 14.4 3 11.82 3 8.65 3 6.07 5.02 4 7.6 4c1.46 0 2.86.68 3.8 1.75A5.1 5.1 0 0 1 15.2 4C17.78 4 19.8 6.07 19.8 8.65c0 3.17-2.85 5.75-7.65 10.13L12 20Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg></button>
                    </div>
                    <div class="pt-3"><div class="flex items-start justify-between gap-2"><h3 class="font-bold leading-snug text-white transition group-hover:text-indigo-300"><a href="https://store.steampowered.com/app/292030/" target="_blank" rel="noopener noreferrer">The Witcher 3: Wild Hunt</a></h3><span class="shrink-0 text-xs text-gray-500">2015</span></div><p class="mt-1 text-xs text-gray-500">PC · PlayStation · Xbox · Switch</p><div class="mt-3 flex flex-wrap gap-1.5"><span class="rounded-md bg-white/5 px-2 py-1 text-[11px] text-gray-400">RPG</span><span class="rounded-md bg-white/5 px-2 py-1 text-[11px] text-gray-400">Open world</span></div></div>
                </article>

                <article data-game-card data-genres="action adventure" data-search="ghost of tsushima action adventure samurai pc playstation" class="game-card group min-w-0">
                    <div class="game-cover relative aspect-[3/4] overflow-hidden rounded-xl bg-gradient-to-br from-rose-950 to-gray-900">
                        <img src="https://cdn.akamai.steamstatic.com/steam/apps/2215430/library_600x900_2x.jpg" alt="Ghost of Tsushima cover art" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-gray-950/90 to-transparent"></div>
                        <span class="absolute bottom-3 left-3 inline-flex items-center gap-1.5 rounded-lg bg-gray-950/80 px-2.5 py-1.5 text-xs font-bold text-emerald-300 backdrop-blur"><span aria-hidden="true">★</span> 8.8</span>
                        <button type="button" data-save-game aria-pressed="false" aria-label="Add Ghost of Tsushima to watchlist" class="absolute right-3 top-3 flex h-9 w-9 items-center justify-center rounded-full border border-white/15 bg-gray-950/70 text-white backdrop-blur transition hover:bg-indigo-500"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m12 20-1.35-1.23C5.85 14.4 3 11.82 3 8.65 3 6.07 5.02 4 7.6 4c1.46 0 2.86.68 3.8 1.75A5.1 5.1 0 0 1 15.2 4C17.78 4 19.8 6.07 19.8 8.65c0 3.17-2.85 5.75-7.65 10.13L12 20Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg></button>
                    </div>
                    <div class="pt-3"><div class="flex items-start justify-between gap-2"><h3 class="font-bold leading-snug text-white transition group-hover:text-indigo-300"><a href="https://store.steampowered.com/app/2215430/" target="_blank" rel="noopener noreferrer">Ghost of Tsushima</a></h3><span class="shrink-0 text-xs text-gray-500">2024</span></div><p class="mt-1 text-xs text-gray-500">PC · PlayStation</p><div class="mt-3 flex flex-wrap gap-1.5"><span class="rounded-md bg-white/5 px-2 py-1 text-[11px] text-gray-400">Action</span><span class="rounded-md bg-white/5 px-2 py-1 text-[11px] text-gray-400">Samurai</span></div></div>
                </article>
            </div>

            <div data-empty-state hidden class="mt-8 rounded-2xl border border-dashed border-white/10 bg-gray-900/50 px-6 py-12 text-center">
                <p class="text-lg font-bold text-white">No games found</p>
                <p class="mt-2 text-sm text-gray-400">Try another title, genre, or add a game to your watchlist.</p>
            </div>
        </section>

        <section id="reviews" class="scroll-mt-28 pt-20">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-300">A little inspiration</p>
                    <h2 class="mt-2 text-3xl font-black tracking-tight text-white">Top-rated adventures</h2>
                </div>
                <p class="max-w-md text-sm leading-6 text-gray-400">Start with the worlds players keep coming back to.</p>
            </div>
            <div class="mt-7 grid gap-4 md:grid-cols-3">
                <article class="rounded-2xl border border-white/10 bg-gray-900/70 p-5">
                    <div class="flex items-center justify-between"><span class="text-xs font-semibold uppercase tracking-widest text-gray-500">Role-playing</span><span class="text-sm font-bold text-emerald-300">9.6 <span class="text-gray-500">/ 10</span></span></div>
                    <h3 class="mt-4 text-lg font-bold text-white">Baldur’s Gate 3</h3>
                    <p class="mt-2 text-sm leading-6 text-gray-400">A sprawling fantasy adventure shaped by your choices and the company you keep.</p>
                </article>
                <article class="rounded-2xl border border-white/10 bg-gray-900/70 p-5">
                    <div class="flex items-center justify-between"><span class="text-xs font-semibold uppercase tracking-widest text-gray-500">Open world</span><span class="text-sm font-bold text-emerald-300">9.5 <span class="text-gray-500">/ 10</span></span></div>
                    <h3 class="mt-4 text-lg font-bold text-white">Elden Ring</h3>
                    <p class="mt-2 text-sm leading-6 text-gray-400">A vast, mysterious world full of formidable foes and rewarding discoveries.</p>
                </article>
                <article class="rounded-2xl border border-white/10 bg-gray-900/70 p-5">
                    <div class="flex items-center justify-between"><span class="text-xs font-semibold uppercase tracking-widest text-gray-500">Story-rich</span><span class="text-sm font-bold text-emerald-300">9.3 <span class="text-gray-500">/ 10</span></span></div>
                    <h3 class="mt-4 text-lg font-bold text-white">The Witcher 3</h3>
                    <p class="mt-2 text-sm leading-6 text-gray-400">A monster hunter’s journey through a richly detailed world and its tangled stories.</p>
                </article>
            </div>
        </section>

        <section id="upcoming" class="scroll-mt-28 pt-20">
            <div class="rounded-3xl border border-indigo-300/10 bg-gradient-to-br from-indigo-950/60 via-gray-900 to-gray-900 p-6 sm:p-9">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div class="max-w-xl">
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-300">Keep an eye out</p>
                        <h2 class="mt-2 text-3xl font-black tracking-tight text-white">More worlds on the horizon.</h2>
                        <p class="mt-3 text-sm leading-6 text-gray-400">A few anticipated adventures to add to your radar. Release timing can change, so check with the publisher for the latest details.</p>
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
