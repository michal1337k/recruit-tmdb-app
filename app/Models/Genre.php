<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
        'tmdb_id',
        'name',
    ];

    public function translations()
    {
        return $this->hasMany(GenreTranslation::class);
    }

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_genre');
    }

    public function series()
    {
        return $this->belongsToMany(Serie::class, 'serie_genre');
    }
}
