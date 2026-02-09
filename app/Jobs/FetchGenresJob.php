<?php

namespace App\Jobs;

use App\Models\Genre;
use App\Services\Tmdb\TmdbClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchGenresJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private string $locale
    ) {}

    public function handle(TmdbClient $tmdb): void
    {
        $response = $tmdb->get('/genre/movie/list', [
            'language' => $this->locale,
        ]);

        foreach ($response['genres'] as $item) {
            $genre = Genre::updateOrCreate(
                ['tmdb_id' => $item['id']],
                []
            );

            $genre->translations()->updateOrCreate(
                ['locale' => $this->locale],
                [
                    'name' => $item['name'],
                ]
            );
        }
    }
}
