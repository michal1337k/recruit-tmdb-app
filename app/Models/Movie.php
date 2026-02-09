<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'tmdb_id',
        'release_date',
        'vote_average',
        'vote_count',
        'popularity',
        'poster_path',
        'backdrop_path',
        'original_language',
    ];

    public function translations()
    {
        return $this->hasMany(MovieTranslation::class);
    }

    // public function translation(string $locale)
    // {
    //     return $this->translations()->where('locale', $locale)->first();
    // }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'movie_genre');
    }

}
