<?php

namespace App\Services;

use Illuminate\Contracts\Cache\Repository as CacheRepository;
use Illuminate\Support\Facades\Http;
use RuntimeException;
use UnexpectedValueException;

class TwitchAccessToken
{
    private const TOKEN_ENDPOINT = 'https://id.twitch.tv/oauth2/token';

    public function __construct(private CacheRepository $cache) {}

    public function get(): string
    {
        $clientId = config('services.twitch.client_id');
        $clientSecret = config('services.twitch.client_secret');

        if (! is_string($clientId) || trim($clientId) === ''
            || ! is_string($clientSecret) || trim($clientSecret) === '') {
            throw new RuntimeException('Set TWITCH_CLIENT_ID and TWITCH_CLIENT_SECRET in your environment.');
        }

        $clientId = trim($clientId);
        $clientSecret = trim($clientSecret);
        $cacheKey = 'twitch.access-token.'.hash('sha256', $clientId.':'.$clientSecret);
        $cachedToken = $this->cache->get($cacheKey);

        if (is_string($cachedToken) && $cachedToken !== '') {
            return $cachedToken;
        }

        $response = Http::asForm()
            ->connectTimeout(3)
            ->timeout(10)
            ->post(self::TOKEN_ENDPOINT, [
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'grant_type' => 'client_credentials',
            ])
            ->throw();

        $accessToken = $response->json('access_token');
        $expiresIn = $response->json('expires_in');

        if (! is_string($accessToken) || trim($accessToken) === ''
            || ! is_int($expiresIn) || $expiresIn <= 0) {
            throw new UnexpectedValueException('Twitch returned an invalid access token response.');
        }

        if ($expiresIn > 60) {
            $this->cache->put($cacheKey, $accessToken, now()->addSeconds($expiresIn - 60));
        }

        return $accessToken;
    }
}
