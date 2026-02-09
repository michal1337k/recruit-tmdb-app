<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovieTranslation extends Model
{
    protected $fillable = [
        'movie_id',
        'locale',
        'title',
        'overview',
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
