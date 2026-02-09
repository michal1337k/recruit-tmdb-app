<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Serie;
use App\Models\Genre;

class SerieApiTest extends TestCase
{
    public function test_series_index_returns_paginated_json()
    {
        $perPage = 10;
        $response = $this->getJson("/api/series?per_page={$perPage}", [
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

    public function test_series_show_returns_serie()
    {
        $serie = Serie::first();
        $this->assertNotNull($serie, 'Brak serialu w bazie danych!');
        $response = $this->getJson("/api/series/{$serie->id}", [
            'Accept-Language' => 'en'
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $serie->id]);
        $this->assertArrayHasKey('translations', $response->json());
    }
}
