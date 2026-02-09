<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::with('translations')
            ->paginate(10);

        return response()->json($genres);
    }

    public function show($id)
    {
        $genre = Genre::with('translations')->findOrFail($id);

        return response()->json($genre);
    }
}
