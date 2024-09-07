@extends('layouts.app')

@section('content')
    <h1>{{ $article->title }}</h1>
    <p>DOI: {{ $article->doi }}</p>
    <p>Authors: {{ $article->authors }}</p>
    <h2>Abstract</h2>
    <p>{{ $article->abstract }}</p>
    <h2>Keywords</h2>
    <p>{{ $article->keywords }}</p>
    <h2>Full Text</h2>
    <div>{{ $article->full_text }}</div>
    <a href="{{ asset('storage/' . $article->pdf_path) }}" target="_blank">Download PDF</a>
@endsection