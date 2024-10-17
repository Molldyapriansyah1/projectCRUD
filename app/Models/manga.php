<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class manga extends Model
{
    protected $fillable = [
        'name',
        'artist',
        'genre',
        'sinopsis',
        'image',
        'cover_image',
        'rating',
    ];
}

