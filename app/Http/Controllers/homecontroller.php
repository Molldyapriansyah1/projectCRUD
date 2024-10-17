<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manga;


class homecontroller extends Controller
{
    public function index()
    {
        $mangas = Manga::all();
        return view('home', compact('mangas'));
    }
}

