@extends('layouts.layout')

@section('content')
<div class="row mb-3">
    <div class="col-3">
        <img src="{{ url('storage/' . $manga->cover_image) }}" alt="{{ $manga->name }}" class="img-fluid" width="200" height="250">
    </div>
    <div class="col-9">
        <h1>{{ $manga->name }}</h1>
        <p>Artist: {{ $manga->artist }}</p>
        <p>Genre: {{ $manga->genre }}</p>
        <p>Sinopsis: {{ $manga->sinopsis }}</p>
        <p>Rating: {{ $manga->rating }}/10</p>
        <img src="{{ url('storage/' . $manga->image) }}" alt="{{ $manga->name }}" class="img-fluid"><br>
        <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
    </div>
    </div>
</div>
@endsection
