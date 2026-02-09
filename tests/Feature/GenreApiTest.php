<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Genre;

class GenreApiTest extends TestCase
{
    public function test_genres_index_returns_paginated_json()
    {
        $perPage = 10;
        $response = $this->getJson("/api/genres?per_page={$perPage}", [
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

    public function test_genres_show_returns_genre()
    {
        $genre = Genre::first();
        $this->assertNotNull($genre, 'Brak gatunku w bazie danych!');
        $response = $this->getJson("/api/genres/{$genre->id}", [
            'Accept-Language' => 'en'
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $genre->id]);
        $this->assertArrayHasKey('translations', $response->json());
    }
}
