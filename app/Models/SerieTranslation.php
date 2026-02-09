<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SerieTranslation extends Model
{
    protected $fillable = [
        'serie_id',
        'locale',
        'name',
        'overview',
    ];

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }
}
