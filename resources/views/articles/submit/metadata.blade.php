@extends('layouts.app')

@section('content')
    <h1>Enter Article Metadata</h1>
    <form action="{{ route('articles.submit.metadata') }}" method="POST">
        @csrf
        <input type="hidden" name="pdf_path" value="{{ $pdf_path }}">
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="abstract" placeholder="Abstract" required></textarea>
        <input type="text" name="keywords" placeholder="Keywords (comma-separated)" required>
        <button type="submit">Submit Metadata</button>
    </form>
@endsection