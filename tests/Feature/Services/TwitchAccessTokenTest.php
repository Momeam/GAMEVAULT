<?php

namespace Tests\Feature\Services;

use App\Services\TwitchAccessToken;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use RuntimeException;
use Tests\TestCase;
use UnexpectedValueException;

class TwitchAccessTokenTest extends TestCase
{
    public function test_it_requests_and_caches_a_twitch_access_token(): void
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
        ]);

        $accessToken = app(TwitchAccessToken::class);

        $this->assertSame('access-token', $accessToken->get());
        $this->assertSame('access-token', $accessToken->get());

        Http::assertSent(fn (Request $request): bool => $request->url() === 'https://id.twitch.tv/oauth2/token'
            && $request->method() === 'POST'
            && $request['client_id'] === 'client-id'
            && $request['client_secret'] === 'client-secret'
            && $request['grant_type'] === 'client_credentials');
        Http::assertSentCount(1);
    }

    public function test_it_requires_twitch_credentials_before_requesting_a_token(): void
    {
        config([
            'services.twitch.client_id' => null,
            'services.twitch.client_secret' => null,
        ]);
        Http::preventStrayRequests();

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Set TWITCH_CLIENT_ID and TWITCH_CLIENT_SECRET');

        app(TwitchAccessToken::class)->get();
    }

    public function test_it_rejects_an_invalid_twitch_token_response(): void
    {
        config([
            'services.twitch.client_id' => 'client-id',
            'services.twitch.client_secret' => 'client-secret',
        ]);
        Http::preventStrayRequests();
        Http::fake([
            'https://id.twitch.tv/oauth2/token' => Http::response([
                'access_token' => 'access-token',
            ]),
        ]);

        $this->expectException(UnexpectedValueException::class);
        $this->expectExceptionMessage('Twitch returned an invalid access token response.');

        app(TwitchAccessToken::class)->get();
    }

    public function test_it_surfaces_twitch_authentication_errors(): void
    {
        config([
            'services.twitch.client_id' => 'client-id',
            'services.twitch.client_secret' => 'client-secret',
        ]);
        Http::preventStrayRequests();
        Http::fake([
            'https://id.twitch.tv/oauth2/token' => Http::response([
                'message' => 'Invalid client',
            ], 401),
        ]);

        $this->expectException(RequestException::class);

        app(TwitchAccessToken::class)->get();
    }
}
