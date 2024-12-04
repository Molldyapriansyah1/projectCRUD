@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('failed'))
        <div class="alert alert-danger">{{ session('failed') }}</div>
    @endif
    <a href="{{ route('chapter.create') }}" class="btn btn-info">tambah chapter</a> <br><br>
    <div class="row">
        @foreach ($chapters as $chapter)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Chapter {{ $chapter->number_chapter }}</h5>
                        <h6>Manga Name: {{ $chapter->manga->name ?? '' }}</h6>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-warning">edit</a>
                        <form action="#" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

