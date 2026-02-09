<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $fillable = [
        'tmdb_id',
        'first_air_date',
        'vote_average',
        'vote_count',
        'popularity',
        'poster_path',
        'backdrop_path',
        'original_language',
    ];

    public function translations()
    {
        return $this->hasMany(SerieTranslation::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'serie_genre');
    }

}
