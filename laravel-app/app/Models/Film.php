<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $primaryKey = 'film_id';

    protected $fillable = [
        'title',
        'description',
        'release_year',
        'genre_id',
        'duration',
        'poster',
        'rating',
    ];
}
