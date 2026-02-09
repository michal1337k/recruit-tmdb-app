<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Movie;

class MovieApiTest extends TestCase
{
    public function test_movies_index_returns_paginated_json()
    {
        $perPage = 10;

        $response = $this->getJson("/api/movies?per_page={$perPage}", [
            'Accept-Language' => 'en'
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'current_page',
            'data',
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'links',
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total',
        ]);

        $this->assertNotEmpty($response->json('data'));
    }

    public function test_movies_show_returns_movie()
    {
        $movie = Movie::first();
        $this->assertNotNull($movie, 'Brak filmu w bazie danych!');
        $response = $this->getJson("/api/movies/{$movie->id}", [
            'Accept-Language' => 'en'
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => $movie->id,
        ]);

        $this->assertArrayHasKey('translations', $response->json());
    }
}
