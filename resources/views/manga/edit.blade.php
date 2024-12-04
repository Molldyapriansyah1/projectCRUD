@extends('layouts.layout')

@section('content')
<h1>Edit Manga</h1>

<form action="{{ route('manga.update', $manga->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('patch')

    <div class="mb-3">
        <label for="name" class="form-label">Nama Manga</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $manga->name) }}">
    </div>
    
    <div class="mb-3">
        <label for="artist" class="form-label">Nama Artis</label>
        <input type="text" class="form-control" id="artist" name="artist" value="{{ old('artist', $manga->artist) }}">
    </div>
    
    <div class="mb-3">
        <label for="genre" class="form-label">Genre</label>
        <input type="text" class="form-control" id="genre" name="genre" value="{{ old('genre', $manga->genre) }}">
    </div>
    
    <div class="mb-3">
        <label for="sinopsis" class="form-label">Deskripsi Manga</label>
        <textarea class="form-control" id="sinopsis" name="sinopsis">{{ old('sinopsis', $manga->sinopsis) }}</textarea>
    </div>
    
    <div class="mb-3">
        <label for="cover_img" class="form-label">Gambar Cover Manga</label>
        <input type="file" class="form-control" id="cover_img" accept="image/*" name="cover_img">
    </div>

    <div class="mb-3">
        <label for="rating" class="form-label">Rating:</label>
        <input type="number" class="form-control" id="rating" name="rating" max="10">
    </div>

    
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection

