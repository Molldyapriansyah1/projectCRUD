@extends('layouts.layout')

@section('content')
<h1>Tambah Manga</h1>
<form action="{{ route('manga.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <div class="mb-3">
        <label for="name" class="form-label">Nama Manga</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="artist" class="form-label">Nama Artis</label>
        <input type="text" class="form-control" id="artist" name="artist" required>
    </div>
    <div class="mb-3">
        <label for="genre" class="form-label">Genre</label>
        <input type="text" class="form-control" id="genre" name="genre" required>
    </div>
    <div class="mb-3">
        <label for="sinopsis" class="form-label">Deskripsi Manga</label>
        <textarea class="form-control" id="sinopsis" name="sinopsis" required></textarea>
    </div>
    <div class="mb-3">
        <label for="rating" class="form-label">Rating</label>
        <input type="number" class="form-control" id="rating" name="rating" required>
    </div>
    <div class="mb-3">
        <label for="img" class="form-label">Gambar Manga</label>
        <input type="file" class="form-control" id="img" accept="image/*" name="img" required>
    </div>
    <div class="mb-3">
        <label for="cover_img" class="form-label">Cover Manga</label>
        <input type="file" class="form-control" id="cover_img" accept="image/*" name="cover_img" required>
    </div>
    <button type="submit" class="btn btn-primary">tambah manga</button>
</form>
@endsection

