<?php

namespace App\Jobs;

use App\Models\Serie;
use App\Services\Tmdb\TmdbClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchSeriesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private string $locale
    ) {}

    public function handle(TmdbClient $tmdb): void
    {
        $allSeries = [];
        $page = 1;

        while (count($allSeries) < 10) {
            $response = $tmdb->get('/tv/popular', [
                'language' => $this->locale,
                'page' => $page,
            ]);

            $allSeries = array_merge($allSeries, $response['results']);
            $page++;
        }

        $series = array_slice($allSeries, 0, 10);

        foreach ($series as $item) {
            $serie = Serie::updateOrCreate(
                ['tmdb_id' => $item['id']],
                [
                    'first_air_date' => $item['first_air_date'] ?? null,
                    'vote_average' => $item['vote_average'] ?? null,
                    'vote_count' => $item['vote_count'] ?? null,
                    'popularity' => $item['popularity'] ?? null,
                    'poster_path' => $item['poster_path'] ?? null,
                    'backdrop_path' => $item['backdrop_path'] ?? null,
                    'original_language' => $item['original_language'] ?? null,
                ]
            );

            $serie->translations()->updateOrCreate(
                ['locale' => $this->locale],
                [
                    'name' => $item['name'],
                    'overview' => $item['overview'] ?? null,
                ]
            );
        }
    }
}
