//
const gameCards = [...document.querySelectorAll('[data-game-card]')];
const searchInput = document.querySelector('[data-game-search]');
const filterButtons = [...document.querySelectorAll('[data-filter]')];
const resultCount = document.querySelector('[data-results-count]');
const emptyState = document.querySelector('[data-empty-state]');
const watchlistCount = document.querySelector('[data-watchlist-count]');
const savedGames = new Set();
let activeFilter = 'all';

function updateGameList() {
    const searchTerm = searchInput.value.trim().toLowerCase();
    let visibleGames = 0;

    gameCards.forEach((card) => {
        const matchesSearch = card.dataset.search.includes(searchTerm);
        const matchesFilter = activeFilter === 'all'
            || (activeFilter === 'saved'
                ? savedGames.has(card)
                : card.dataset.genres.split(' ').includes(activeFilter));

        card.hidden = !(matchesSearch && matchesFilter);

        if (!card.hidden) {
            visibleGames += 1;
        }
    });

    resultCount.textContent = `Showing ${visibleGames} ${visibleGames === 1 ? 'game' : 'games'}`;
    emptyState.hidden = visibleGames > 0;
}

function selectFilter(filter) {
    activeFilter = filter;

    filterButtons.forEach((button) => {
        const isSelected = button.dataset.filter === filter;
        button.setAttribute('aria-pressed', String(isSelected));
        button.classList.toggle('border-indigo-400', isSelected);
        button.classList.toggle('bg-indigo-500/15', isSelected);
        button.classList.toggle('text-white', isSelected);
        button.classList.toggle('border-white/10', !isSelected);
        button.classList.toggle('bg-gray-900', !isSelected);
        button.classList.toggle('text-gray-400', !isSelected);
    });

    updateGameList();
}

filterButtons.forEach((button) => {
    button.addEventListener('click', () => selectFilter(button.dataset.filter));
});

searchInput.addEventListener('input', updateGameList);

document.querySelectorAll('[data-save-game]').forEach((button) => {
    const card = button.closest('[data-game-card]');
    const gameTitle = card.querySelector('h3').textContent.trim();

    button.addEventListener('click', () => {
        if (savedGames.has(card)) {
            savedGames.delete(card);
            button.setAttribute('aria-pressed', 'false');
            button.setAttribute('aria-label', `Add ${gameTitle} to watchlist`);
            button.classList.remove('is-saved');
        } else {
            savedGames.add(card);
            button.setAttribute('aria-pressed', 'true');
            button.setAttribute('aria-label', `Remove ${gameTitle} from watchlist`);
            button.classList.add('is-saved');
        }

        watchlistCount.textContent = String(savedGames.size);

        if (activeFilter === 'saved') {
            updateGameList();
        }
    });
});

document.querySelectorAll('.game-cover img').forEach((image) => {
    image.addEventListener('error', () => {
        image.hidden = true;
    }, { once: true });
});

updateGameList();
