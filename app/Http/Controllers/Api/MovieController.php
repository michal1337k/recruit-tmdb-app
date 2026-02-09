<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        $perPage = request()->get('per_page', 10);
        $movies = Movie::with(['translations' => function($q) {
            $q->where('locale', app()->getLocale());
        }, 'genres.translations'])->paginate($perPage);

        //return $movies;
        return response()->json($movies);
    }

    public function show(Movie $movie)
    {
        $movie->load(['translations' => function($q){
            $q->where('locale', app()->getLocale());
        }, 'genres.translations']);

        //return $movie;
        return response()->json($movie);
    }

}
