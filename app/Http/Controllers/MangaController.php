<?php
namespace App\Http\Controllers;

use App\Models\Manga; // Use correct casing for model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MangaController extends Controller
{
    public function index()
    {
        $mangas = Manga::all();
        return view('manga.index', compact('mangas'));
    }

    public function create()
    {
        return view('manga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'artist' => 'required',
            'genre' => 'required',
            'sinopsis' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cover_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'rating' => 'required|numeric|min:0|max:10'
        ]);

        $imagePath = $request->file('img')->store('images', 'public');
        $coverImagePath = $request->file('cover_img')->store('images', 'public');

        Manga::create([
            'name' => $request->input('name'),
            'artist' => $request->input('artist'),
            'genre' => $request->input('genre'),
            'sinopsis' => $request->input('sinopsis'),
            'image' => $imagePath,
            'cover_image' => $coverImagePath,
            'rating' => $request->input('rating')
        ]);

        return redirect()->route('manga.index')->with('success', 'Manga berhasil ditambahkan');
    }

    public function show(Manga $manga)
    {
        return view('manga.show', compact('manga'));
    }

    public function edit(Manga $manga)
    {
        return view('manga.edit', compact('manga'));
    }

    public function update(Request $request, Manga $manga)
    {
        $request->validate([
            'name' => 'required',
            'artist' => 'required',
            'genre' => 'required',
            'sinopsis' => 'required',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cover_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'rating' => 'required|numeric|min:0|max:10'
        ]);

        $manga->name = $request->input('name');
        $manga->artist = $request->input('artist');
        $manga->genre = $request->input('genre');
        $manga->sinopsis = $request->input('sinopsis');
        $manga->rating = $request->input('rating');

        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('images', 'public');
            $manga->image = $imagePath;
        }

        if ($request->hasFile('cover_img')) {
            $coverImagePath = $request->file('cover_img')->store('images', 'public');
            $manga->cover_image = $coverImagePath;
        }

        $manga->save();
        return redirect()->route('manga.index', $manga->id)->with('success', 'Manga berhasil diupdate');
    }

    public function destroy(Manga $manga)
    {
        if (Storage::exists('public/' . $manga->image)) {
            Storage::delete('public/' . $manga->image);
        }

        if (Storage::exists('public/' . $manga->cover_image)) {
            Storage::delete('public/' . $manga->cover_image);
        }

        $manga->delete();
        return redirect()->route('manga.index')->with('success', 'Manga deleted successfully');
    }
}

