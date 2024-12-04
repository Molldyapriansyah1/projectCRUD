@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('failed'))
        <div class="alert alert-danger">{{ session('failed') }}</div>
    @endif
    <div class="row">
        @foreach ($mangas as $ma)
        <div class="col-md-4">
            <div class="card" style="width: 20rem;">
                <img src="{{ asset('storage/' . $ma->cover_image) }}" class="card-img-top" style="max-height: 350px; max-width: 350px;" alt="{{ $ma->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $ma->name }}</h5>
                    <p class="card-text"><strong>Artist:</strong> {{ $ma->artist }}</p>
                    <p class="card-text"><strong>Genre:</strong> {{ $ma->genre }}</p>
                    @if (Str::length($ma->sinopsis) > 100)
                        <p><strong>Sinopsis:</strong> {{ Str::limit($ma->sinopsis, 70) }} <a href="#" data-bs-toggle="collapse" data-bs-target="#sinopsis-{{ $ma->id }}" aria-expanded="false" aria-controls="sinopsis-{{ $ma->id }}">Read More</a></p>
                        <div class="collapse" id="sinopsis-{{ $ma->id }}">
                            <p>{{ $ma->sinopsis }}</p>
                        </div>
                    @else
                        <p><strong>Sinopsis:</strong> {{ $ma->sinopsis }}</p>
                    @endif
                    <p class="card-text"><strong>Rating:</strong> {{ $ma->rating }}</p>
                    <a href="{{ route('manga.edit', $ma->id) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ route('chapter.index', $ma->id) }}" class="btn btn-info">detail chapter</a>
                    <form action="{{ route('manga.destroy', $ma->id) }}" method="post" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

