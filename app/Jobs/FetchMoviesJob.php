<?php

namespace App\Jobs;

use App\Models\Movie;
use App\Services\Tmdb\TmdbClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchMoviesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private string $locale
    ) {}

    public function handle(TmdbClient $tmdb): void
    {
        $allMovies = [];
        $page = 1;

        while (count($allMovies) < 50) {
            $response = $tmdb->get('/movie/popular', [
                'language' => $this->locale,
                'page' => $page,
            ]);

            $allMovies = array_merge(
                $allMovies,
                $response['results']
            );

            $page++;
        }

        $movies = array_slice($allMovies, 0, 50);

        foreach ($movies as $item) {
            $movie = Movie::updateOrCreate(
                ['tmdb_id' => $item['id']],
                [
                    'release_date' => $item['release_date'] ?? null,
                    'vote_average' => $item['vote_average'] ?? null,
                    'vote_count' => $item['vote_count'] ?? null,
                    'popularity' => $item['popularity'] ?? null,
                    'poster_path' => $item['poster_path'] ?? null,
                    'backdrop_path' => $item['backdrop_path'] ?? null,
                    'original_language' => $item['original_language'] ?? null,
                ]
            );

            $movie->translations()->updateOrCreate(
                ['locale' => $this->locale],
                [
                    'title' => $item['title'],
                    'overview' => $item['overview'] ?? null,
                ]
            );
        }
    }
}
