<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Livewire\Component;

class SearchDropdown extends Component
{
    public string $search = '';

    public function clearSearch(): void
    {
        $this->search = '';
    }

    public function render(): View
    {
        $search = Str::lower(trim($this->search));

        $games = mb_strlen($search) < 2
            ? collect()
            : collect(config('game_catalog'))
                ->filter(function (array $game) use ($search): bool {
                    $searchableText = Str::lower(implode(' ', [
                        $game['name'],
                        ...$game['genres'],
                        ...$game['platforms'],
                        ...$game['keywords'],
                    ]));

                    return Str::contains($searchableText, $search);
                })
                ->take(5)
                ->values();

        return view('livewire.search-dropdown', [
            'games' => $games,
        ]);
    }
}
