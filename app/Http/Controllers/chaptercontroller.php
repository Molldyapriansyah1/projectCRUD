<?php
namespace App\Http\Controllers;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class chaptercontroller extends Controller
{
    public function index()
    {
        $chapters = Chapter::all();
        return view('chapter.index', compact('chapters'));
    }

    public function create()
    {
        $mangas = \App\Models\Manga::all();
        return view('chapter.create', compact('mangas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'manga_id' => 'required|exists:mangas,id'
        ]);

        $chapterImagePath = $request->file('image')->store('chapter', 'public');
        $chapter = new Chapter();
        $chapter->number_chapter = $request->input('number');
        $chapter->image = $chapterImagePath;
        $chapter->manga_id = $request->input('manga_id');
        $chapter->save();

        return redirect()->route('chapter.index')->with('success', 'Chapter created successfully');
    }

    public function edit(Chapter $chapter)
    {
        $mangas = \App\Models\Manga::all();
        return view('chapter.edit', compact('chapter', 'mangas'));
    }

    public function update(Request $request, Chapter $chapter)
    {
        $request->validate([
            'number' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'manga_id' => 'required|exists:mangas,id'
        ]);

        if (Storage::exists('public/' . $chapter->image)) {
            Storage::delete('public/' . $chapter->image);
        }

        $chapterImagePath = $request->file('image')->store('chapter', 'public');
        $chapter->number_chapter = $request->input('number');
        $chapter->image = $chapterImagePath;
        $chapter->manga_id = $request->input('manga_id');
        $chapter->save();

        return redirect()->route('chapter.index')->with('success', 'Chapter updated successfully');
    }

    public function destroy(Chapter $chapter)
    {
        if (Storage::exists('public/' . $chapter->image)) {
            Storage::delete('public/' . $chapter->image);
        }

        $chapter->delete();
        return redirect()->route('chapter.index')->with('success', 'Chapter deleted successfully');
    }
    // In your ChapterController.php
    public function show(Chapter $chapter)
    {
        return view('chapters.show', compact('chapter'));
    }
}

