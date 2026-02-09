<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GenreTranslation extends Model
{
    protected $fillable = [
        'genre_id',
        'locale',
        'name',
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
