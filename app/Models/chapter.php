<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class chapter extends Model
{
    protected $fillable = [
        'chapter_number',
        'image',
        'manga_id',
        'manga_name',
    ];
}
