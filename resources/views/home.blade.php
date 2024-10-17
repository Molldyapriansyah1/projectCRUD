@extends('layouts.layout')
@section('content')
<div class="container mt-5">
    <div class="row">
        @foreach ($mangas as $ma)
        <div class="col-md-4">
            <div class="card mb-3">
                    <!-- Gambar Manga -->
                    <img src="{{ url('storage/' . $ma->cover_image) }}" alt="{{ $ma->name }}" class="card-img-top mx-auto d-block" style="width: 300px; height: 400px;">
                <div class="card-body">
                    <!-- Nama Manga -->
                    <h5 class="card-title">{{ $ma->name }}</h5>
                    
                    <!-- Artis -->
                    <p class="card-text">Artist: {{ $ma->artist }}</p>
                    
                    <!-- Genre -->
                    <p class="card-text">Genre: {{ $ma->genre }}</p>
                    
                    <!-- Rating -->
                    <p class="card-text">Rating: {{ $ma->rating }}/10</p> 
                </div>
                <div class="card-footer">
                    <a href="{{ route('manga.show', $ma->id) }}" class="btn btn-primary">Detail</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

