<div
    class="relative w-36 sm:w-64"
    x-data="{ isOpen: false }"
    x-on:click.outside="isOpen = false"
>
    <label for="game-search" class="sr-only">Search games</label>
    <div class="relative">
        <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-500 sm:left-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="m20 20-4.5-4.5m2-5.5a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
        </svg>
        <input
            id="game-search"
            type="search"
            wire:model.live.debounce.300ms="search"
            wire:keydown.escape="clearSearch"
            x-on:focus="isOpen = true"
            maxlength="80"
            autocomplete="off"
            placeholder="Search games..."
            aria-label="Search games"
            aria-controls="game-search-results"
            class="w-full rounded-full border border-white/10 bg-white/5 py-2.5 pl-9 pr-3 text-sm text-white outline-none transition placeholder:text-gray-500 focus:border-indigo-400/60 focus:ring-2 focus:ring-indigo-400/20 sm:pl-11 sm:pr-4"
        >
    </div>

    @if (trim($search) !== '')
        <div
            id="game-search-results"
            x-cloak
            x-show="isOpen"
            class="absolute right-0 top-full z-50 mt-3 w-[min(20rem,calc(100vw-2.5rem))] overflow-hidden rounded-xl border border-white/10 bg-gray-900 text-sm shadow-2xl shadow-black/50"
        >
            @if (mb_strlen(trim($search)) < 2)
                <p class="px-4 py-3 text-gray-400">Type at least 2 characters to search.</p>
            @elseif ($games->isEmpty())
                <p class="px-4 py-3 text-gray-400">No games found for “{{ $search }}”.</p>
            @else
                <ul role="listbox" aria-label="Game search results">
                    @foreach ($games as $game)
                        <li wire:key="search-result-{{ $game['steam_id'] }}" role="option" aria-selected="false" class="border-b border-white/5 last:border-b-0">
                            <a
                                href="https://store.steampowered.com/app/{{ $game['steam_id'] }}/"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex items-center gap-3 px-3 py-2.5 transition hover:bg-gray-800 focus:bg-gray-800 focus:outline-none"
                                x-on:click="isOpen = false"
                            >
                                <img
                                    src="https://cdn.akamai.steamstatic.com/steam/apps/{{ $game['steam_id'] }}/library_600x900_2x.jpg"
                                    alt=""
                                    loading="lazy"
                                    class="h-12 w-9 rounded-md bg-gray-800 object-cover"
                                >
                                <span class="min-w-0 flex-1">
                                    <span class="block truncate font-semibold text-gray-100">{{ $game['name'] }}</span>
                                    <span class="mt-0.5 block truncate text-xs text-gray-500">{{ implode(' · ', $game['genres']) }}</span>
                                </span>
                                <span class="shrink-0 text-xs font-semibold text-emerald-300">★ {{ $game['rating'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endif
</div>
