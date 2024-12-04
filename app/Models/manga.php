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
        'cover_image',
        'rating'
    ];
    // In your Manga.php model
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}

