@extends('layouts.layout')

@section('content')
<div class="row mb-3">
    <div class="col-md-3">
        <img src="{{ url('storage/' . $manga->cover_image) }}" alt="{{ $manga->name }}" class="img-fluid rounded" width="200" height="250">
    </div>
    <div class="col-md-9">
        <h1>{{ $manga->name }}</h1>
        <p><strong>Artist:</strong> {{ $manga->artist }}</p>
        <p><strong>Genre:</strong> {{ $manga->genre }}</p>
        <p><strong>Sinopsis:</strong> {{ $manga->sinopsis }}</p>
        <p><strong>Rating:</strong> {{ $manga->rating }}/10</p>

        @if($chapters && $chapters->isNotEmpty())
        <h2>Chapters:</h2>
            <ul class="list-group">
                @foreach ($chapters as $chapter)
                    <li class="list-group-item">
                        <a href="{{ route('chapter.show', $chapter->id) }}">Chapter {{ $chapter->number_chapter }}</a>
                        <span class="text-muted">{{ $chapter->created_at->format('M d, Y') }}</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-muted">No chapters available.</p>
        @endif
        <br>
        <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection

