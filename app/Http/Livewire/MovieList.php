<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Movie;

class MovieList extends Component
{
    use WithPagination;

    public string $locale;

    public function mount(string $locale)
    {
        $this->locale = $locale;
    }

    public function render()
    {
        $movies = Movie::with('translations')
            ->whereHas('translations', fn($q) => $q->where('locale', $this->locale))
            ->paginate(10);

        return view('livewire.movie-list', [
            'movies' => $movies,
        ]);
    }
}
