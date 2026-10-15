<?php

namespace Tests\Feature;

use App\Livewire\SearchDropdown;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class SearchDropdownTest extends TestCase
{
    public function test_search_displays_games_returned_by_igdb(): void
    {
        config([
            'services.twitch.client_id' => 'client-id',
            'services.twitch.client_secret' => 'client-secret',
        ]);
        Http::preventStrayRequests();
        Http::fake([
            'https://id.twitch.tv/oauth2/token' => Http::response([
                'access_token' => 'access-token',
                'expires_in' => 3600,
                'token_type' => 'bearer',
            ]),
            'https://api.igdb.com/v4/games' => Http::response([
                [
                    'id' => 123,
                    'name' => 'Cyberpunk 2077',
                    'slug' => 'cyberpunk-2077',
                    'rating' => 92.0,
                    'cover' => ['image_id' => 'co1rgi'],
                    'genres' => [['name' => 'Role-playing (RPG)']],
                    'platforms' => [['name' => 'PC']],
                ],
            ]),
        ]);

        Livewire::test(SearchDropdown::class)
            ->set('search', 'cyber')
            ->assertSee('Cyberpunk 2077')
            ->assertSee('https://www.igdb.com/games/cyberpunk-2077')
            ->assertSee('https://images.igdb.com/igdb/image/upload/t_cover_big/co1rgi.jpg');

        Http::assertSent(fn (Request $request): bool => $request->url() === 'https://api.igdb.com/v4/games'
            && str_contains($request->body(), 'search "cyber";'));
    }

    public function test_search_requires_at_least_two_characters(): void
    {
        Http::preventStrayRequests();

        Livewire::test(SearchDropdown::class)
            ->set('search', 'a')
            ->assertSee('Type at least 2 characters to search.')
            ->assertDontSee('Cyberpunk 2077');
    }

    public function test_search_explains_when_twitch_credentials_are_missing(): void
    {
        config([
            'services.twitch.client_id' => null,
            'services.twitch.client_secret' => null,
        ]);
        Http::preventStrayRequests();

        Livewire::test(SearchDropdown::class)
            ->set('search', 'cyber')
            ->assertSee('Add your Twitch credentials to .env to search IGDB.');
    }

    public function test_search_shows_feedback_when_no_games_match(): void
    {
        config([
            'services.twitch.client_id' => 'client-id',
            'services.twitch.client_secret' => 'client-secret',
        ]);
        Http::preventStrayRequests();
        Http::fake([
            'https://id.twitch.tv/oauth2/token' => Http::response([
                'access_token' => 'access-token',
                'expires_in' => 3600,
                'token_type' => 'bearer',
            ]),
            'https://api.igdb.com/v4/games' => Http::response([]),
        ]);

        Livewire::test(SearchDropdown::class)
            ->set('search', 'not-a-real-game')
            ->assertSee('No games found');
    }
}
