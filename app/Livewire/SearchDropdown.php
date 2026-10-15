<?php

namespace App\Livewire;

use App\Services\IgdbGameCatalog;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class SearchDropdown extends Component
{
    protected IgdbGameCatalog $catalog;

    public string $search = '';

    public function boot(IgdbGameCatalog $catalog): void
    {
        $this->catalog = $catalog;
    }

    public function clearSearch(): void
    {
        $this->search = '';
    }

    public function render(): View
    {
        $search = trim($this->search);
        $igdbConfigured = filled(config('services.twitch.client_id'))
            && filled(config('services.twitch.client_secret'));

        $games = mb_strlen($search) < 2 || ! $igdbConfigured
            ? collect()
            : $this->catalog->search($search);

        return view('livewire.search-dropdown', [
            'games' => $games,
            'igdbConfigured' => $igdbConfigured,
        ]);
    }
}
