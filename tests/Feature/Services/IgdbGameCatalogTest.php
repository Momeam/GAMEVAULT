<?php

namespace Tests\Feature\Services;

use App\Services\IgdbGameCatalog;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class IgdbGameCatalogTest extends TestCase
{
    public function test_it_fetches_normalizes_and_caches_popular_igdb_games(): void
    {
        config([
            'services.twitch.client_id' => 'client-id',
            'services.twitch.client_secret' => 'client-secret',
        ]);
        Cache::flush();
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
                    'rating' => 92.5,
                    'first_release_date' => 1577836800,
                    'cover' => ['image_id' => 'co1rgi'],
                    'genres' => [
                        ['name' => 'Role-playing (RPG)'],
                        ['name' => 'Adventure'],
                    ],
                    'platforms' => [
                        ['name' => 'PC (Microsoft Windows)'],
                    ],
                ],
            ]),
        ]);

        $catalog = app(IgdbGameCatalog::class);
        $games = $catalog->popular();
        $catalog->popular();

        $this->assertSame([
            [
                'id' => 123,
                'name' => 'Cyberpunk 2077',
                'url' => 'https://www.igdb.com/games/cyberpunk-2077',
                'cover_url' => 'https://images.igdb.com/igdb/image/upload/t_cover_big/co1rgi.jpg',
                'genres' => ['Role-playing (RPG)', 'Adventure'],
                'genre_slugs' => ['rpg', 'adventure'],
                'platforms' => ['PC (Microsoft Windows)'],
                'year' => 2020,
                'rating' => '9.3',
            ],
        ], $games->all());

        Http::assertSent(fn (Request $request): bool => $request->url() === 'https://api.igdb.com/v4/games'
            && $request->hasHeader('Client-ID', 'client-id')
            && $request->hasHeader('Authorization', 'Bearer access-token')
            && str_contains($request->body(), 'rating_count > 100'));
        Http::assertSentCount(2);
    }

    public function test_it_escapes_search_terms_before_sending_igdb_queries(): void
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

        app(IgdbGameCatalog::class)->search('test"; limit 100; //');

        Http::assertSent(fn (Request $request): bool => $request->url() === 'https://api.igdb.com/v4/games'
            && str_contains($request->body(), 'search "test\\"; limit 100; //";')
            && ! str_contains($request->body(), 'search "test"; limit'));
    }
}
