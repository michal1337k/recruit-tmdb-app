<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Serie;

class SerieController extends Controller
{
    public function index()
    {
        $series = Serie::with('translations')
            ->paginate(10);

        return response()->json($series);
    }

    public function show($id)
    {
        $serie = Serie::with('translations')->findOrFail($id);

        return response()->json($serie);
    }
}
