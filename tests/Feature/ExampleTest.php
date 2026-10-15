<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_homepage_displays_the_game_catalog_and_discovery_sections(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('Popular games')
            ->assertSee('Cyberpunk 2077')
            ->assertSee('store.steampowered.com/app/1091500')
            ->assertSee('Search by title or genre...')
            ->assertSee('Top-rated adventures')
            ->assertSee('The Witcher IV');
    }
}
