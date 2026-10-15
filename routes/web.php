<?php

use App\Services\IgdbGameCatalog;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

Route::get('/', function (IgdbGameCatalog $catalog): View {
    $igdbConfigured = filled(config('services.twitch.client_id'))
        && filled(config('services.twitch.client_secret'));

    return view('index', [
        'games' => $igdbConfigured ? $catalog->popular() : collect(),
        'igdbConfigured' => $igdbConfigured,
    ]);
})->name('home');
