<?php

namespace Tests\Feature\Console\Commands;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GetIgdbAccessTokenTest extends TestCase
{
    public function test_it_confirms_token_creation_without_printing_the_token(): void
    {
        config([
            'services.twitch.client_id' => 'client-id',
            'services.twitch.client_secret' => 'client-secret',
        ]);
        Cache::flush();
        Http::preventStrayRequests();
        Http::fake([
            'https://id.twitch.tv/oauth2/token' => Http::response([
                'access_token' => 'secret-access-token',
                'expires_in' => 3600,
                'token_type' => 'bearer',
            ]),
        ]);

        $this->artisan('igdb:token')
            ->expectsOutput('IGDB access token acquired and cached.')
            ->doesntExpectOutput('secret-access-token')
            ->assertExitCode(0);
    }
}
