<?php

namespace App\Console\Commands;

use App\Jobs\FetchMoviesJob;
use App\Jobs\FetchSeriesJob;
use App\Jobs\FetchGenresJob;
use Illuminate\Console\Command;

class FetchTmdbData extends Command
{
    protected $signature = 'tmdb:fetch';
    protected $description = 'Fetch movies, series, and genres from TMDB | Pobierz filmy, seriale i gatunki z TMDB';

    public function handle(): int
    {

        $locales = ['pl', 'en', 'de'];

        foreach ($locales as $locale) {
            FetchMoviesJob::dispatch($locale);
            FetchSeriesJob::dispatch($locale);
            FetchGenresJob::dispatch($locale);
        }

        $this->info('TMDB jobs dispatched for movies, series, and genres.');
        $this->info('Dane z TMDB zostały wysłane do kolejki.');

        return self::SUCCESS;
    }
}
