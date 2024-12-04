@extends('layouts.layout')

@section('content')
<h1>Create a New Chapter</h1>

<form action="{{ route('chapter.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="number">Number:</label>
        <input type="text" class="form-control" name="number" id="number" required>
    </div>

    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" class="form-control" name="image" id="image">
    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>

@endsection
