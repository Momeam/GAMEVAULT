<?php

namespace Tests\Feature;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_homepage_displays_games_returned_by_igdb(): void
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
                    'first_release_date' => 1608595200,
                    'cover' => ['image_id' => 'co1rgi'],
                    'genres' => [['name' => 'Role-playing (RPG)']],
                    'platforms' => [['name' => 'PC (Microsoft Windows)']],
                ],
            ]),
        ]);

        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('Popular games')
            ->assertSee('Cyberpunk 2077')
            ->assertSee('https://www.igdb.com/games/cyberpunk-2077')
            ->assertSee('https://images.igdb.com/igdb/image/upload/t_cover_big/co1rgi.jpg')
            ->assertSee('Search games...')
            ->assertSee('Top-rated adventures')
            ->assertSee('The Witcher IV')
            ->assertDontSee('store.steampowered.com');

        Http::assertSent(fn (Request $request): bool => $request->url() === 'https://api.igdb.com/v4/games'
            && str_contains($request->body(), 'rating_count > 100'));
    }

    public function test_homepage_explains_when_twitch_credentials_are_missing(): void
    {
        config([
            'services.twitch.client_id' => null,
            'services.twitch.client_secret' => null,
        ]);
        Http::preventStrayRequests();

        $this->get('/')
            ->assertOk()
            ->assertSee('Add TWITCH_CLIENT_ID and TWITCH_CLIENT_SECRET to your .env file')
            ->assertDontSee('Cyberpunk 2077');
    }
}
