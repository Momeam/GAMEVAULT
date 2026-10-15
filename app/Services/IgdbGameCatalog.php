<?php

namespace App\Services;

use Illuminate\Contracts\Cache\Repository as CacheRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use UnexpectedValueException;

class IgdbGameCatalog
{
    private const API_URL = 'https://api.igdb.com/v4/games';

    private const FIELDS = 'name,slug,url,rating,first_release_date,cover.image_id,genres.name,platforms.name';

    public function __construct(
        private TwitchAccessToken $accessToken,
        private CacheRepository $cache,
    ) {}

    /**
     * @return Collection<int, array{
     *     id: int,
     *     name: string,
     *     url: string,
     *     cover_url: ?string,
     *     genres: list<string>,
     *     genre_slugs: list<string>,
     *     platforms: list<string>,
     *     year: ?int,
     *     rating: ?string
     * }>
     */
    public function popular(): Collection
    {
        return $this->cache->remember(
            'igdb.games.popular',
            now()->addMinutes(30),
            fn (): Collection => $this->requestGames(
                'fields '.self::FIELDS.'; where rating != null & rating_count > 100; sort rating desc; limit 20;'
            ),
        );
    }

    /**
     * @return Collection<int, array{
     *     id: int,
     *     name: string,
     *     url: string,
     *     cover_url: ?string,
     *     genres: list<string>,
     *     genre_slugs: list<string>,
     *     platforms: list<string>,
     *     year: ?int,
     *     rating: ?string
     * }>
     */
    public function search(string $term): Collection
    {
        $term = Str::limit(trim($term), 80, '');
        $escapedTerm = addcslashes($term, '\\"');
        $query = 'search "'.$escapedTerm.'"; fields '.self::FIELDS.'; limit 5;';

        return $this->cache->remember(
            'igdb.games.search.'.hash('sha256', Str::lower($term)),
            now()->addMinutes(30),
            fn (): Collection => $this->requestGames($query),
        );
    }

    /**
     * @return Collection<int, array{
     *     id: int,
     *     name: string,
     *     url: string,
     *     cover_url: ?string,
     *     genres: list<string>,
     *     genre_slugs: list<string>,
     *     platforms: list<string>,
     *     year: ?int,
     *     rating: ?string
     * }>
     */
    private function requestGames(string $query): Collection
    {
        $clientId = config('services.twitch.client_id');
        $response = Http::withHeaders([
            'Client-ID' => $clientId,
            'Authorization' => 'Bearer '.$this->accessToken->get(),
        ])
            ->connectTimeout(3)
            ->timeout(10)
            ->withBody($query, 'text/plain')
            ->post(self::API_URL)
            ->throw();

        $games = $response->json();

        if (! is_array($games) || ! array_is_list($games)) {
            throw new UnexpectedValueException('IGDB returned an invalid games response.');
        }

        foreach ($games as $game) {
            if (! is_array($game) || ! isset($game['id'], $game['name'])
                || ! is_int($game['id']) || ! is_string($game['name'])) {
                throw new UnexpectedValueException('IGDB returned a game with invalid data.');
            }
        }

        return collect($games)
            ->map(fn (array $game): array => $this->normalizeGame($game))
            ->values();
    }

    /**
     * @param  array<string, mixed>  $game
     * @return array{
     *     id: int,
     *     name: string,
     *     url: string,
     *     cover_url: ?string,
     *     genres: list<string>,
     *     genre_slugs: list<string>,
     *     platforms: list<string>,
     *     year: ?int,
     *     rating: ?string
     * }
     */
    private function normalizeGame(array $game): array
    {
        $genres = collect($game['genres'] ?? [])
            ->pluck('name')
            ->filter(fn (mixed $name): bool => is_string($name) && $name !== '')
            ->values()
            ->all();

        $platforms = collect($game['platforms'] ?? [])
            ->pluck('name')
            ->filter(fn (mixed $name): bool => is_string($name) && $name !== '')
            ->values()
            ->all();

        $genreSlugs = collect($genres)
            ->map(function (string $genre): string {
                $normalizedGenre = Str::lower($genre);

                return match (true) {
                    Str::contains($normalizedGenre, ['role-playing', 'rpg']) => 'rpg',
                    Str::contains($normalizedGenre, 'action') => 'action',
                    Str::contains($normalizedGenre, 'adventure') => 'adventure',
                    Str::contains($normalizedGenre, 'indie') => 'indie',
                    default => Str::slug($genre),
                };
            })
            ->unique()
            ->values()
            ->all();

        $slug = is_string($game['slug'] ?? null) && $game['slug'] !== ''
            ? $game['slug']
            : Str::slug($game['name']);
        $coverId = data_get($game, 'cover.image_id');
        $releaseDate = $game['first_release_date'] ?? null;
        $rating = $game['rating'] ?? null;

        return [
            'id' => $game['id'],
            'name' => $game['name'],
            'url' => 'https://www.igdb.com/games/'.rawurlencode($slug),
            'cover_url' => is_string($coverId) && $coverId !== ''
                ? 'https://images.igdb.com/igdb/image/upload/t_cover_big/'.rawurlencode($coverId).'.jpg'
                : null,
            'genres' => $genres,
            'genre_slugs' => $genreSlugs,
            'platforms' => $platforms,
            'year' => is_int($releaseDate) && $releaseDate > 0
                ? Carbon::createFromTimestampUTC($releaseDate)->year
                : null,
            'rating' => is_numeric($rating) ? number_format((float) $rating / 10, 1) : null,
        ];
    }
}
