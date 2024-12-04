@extends('layouts.layout')

@section('content')
<h1>Chapter {{ $chapter->number_chapter ?? '' }}</h1>

@if (isset($chapter->image))
    <img src="{{ Storage::url('chapter/' . $chapter->image) }}" alt="Chapter Image">
@endif

