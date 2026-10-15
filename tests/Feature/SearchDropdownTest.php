<?php

namespace Tests\Feature;

use App\Livewire\SearchDropdown;
use Livewire\Livewire;
use Tests\TestCase;

class SearchDropdownTest extends TestCase
{
    public function test_search_returns_matching_games_and_store_links(): void
    {
        Livewire::test(SearchDropdown::class)
            ->set('search', 'cyber')
            ->assertSee('Cyberpunk 2077')
            ->assertSee('store.steampowered.com/app/1091500')
            ->assertDontSee('Elden Ring');
    }

    public function test_search_matches_game_genres(): void
    {
        Livewire::test(SearchDropdown::class)
            ->set('search', 'indie')
            ->assertSee('Stardew Valley')
            ->assertSee('Hades')
            ->assertDontSee('Cyberpunk 2077');
    }

    public function test_search_requires_at_least_two_characters(): void
    {
        Livewire::test(SearchDropdown::class)
            ->set('search', 'a')
            ->assertSee('Type at least 2 characters to search.')
            ->assertDontSee('Cyberpunk 2077');
    }

    public function test_search_shows_feedback_when_no_games_match(): void
    {
        Livewire::test(SearchDropdown::class)
            ->set('search', 'not-a-real-game')
            ->assertSee('No games found');
    }
}
