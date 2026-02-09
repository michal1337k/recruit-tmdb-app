<?php

use Illuminate\Support\Facades\Route;
use App\Services\Tmdb\TmdbClient;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/tmdb-test', function (TmdbClient $tmdb) {
// return $tmdb->get('/movie/popular');
// });

Route::get('/movies-list', fn() => view('movies-list'));
