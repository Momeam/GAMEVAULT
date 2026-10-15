<?php

namespace App\Console\Commands;

use App\Services\TwitchAccessToken;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('igdb:token')]
#[Description('Verify Twitch credentials and cache an IGDB access token')]
class GetIgdbAccessToken extends Command
{
    public function handle(TwitchAccessToken $accessToken): int
    {
        $accessToken->get();

        $this->info('IGDB access token acquired and cached.');

        return self::SUCCESS;
    }
}
