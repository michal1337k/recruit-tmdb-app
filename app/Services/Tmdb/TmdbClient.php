<?php

namespace App\Services\Tmdb;

use Illuminate\Support\Facades\Http;

class TmdbClient
{
    private string $url = 'https://api.themoviedb.org/3';

    public function get(string $endpoint, array $params = []): array
    {
        $response = Http::get(
            $this->url . $endpoint,
            array_merge([
                'api_key' => config('services.tmdb.key'),
            ], $params)
        );

        return $response->json();
    }
}
