@extends('layouts.app')

@section('title', $article->article->title)

@section('head')
    <meta name="citation_title" content="{{ $article->article->title }}">
    <meta name="citation_author" content="Author Name"> <!-- Replace with actual author data -->
    <meta name="citation_publication_date" content="{{ $article->published_at->format('Y/m/d') }}">
    <meta name="citation_journal_title" content="Uly Dala Journal">
    <meta name="citation_pdf_url" content="{{ asset('storage/' . $article->article->file_path) }}">
@endsection

@section('content')
    <h1>{{ $article->article->title }}</h1>
    <p>{{ $article->article->abstract }}</p>
    <p>DOI: {{ $article->doi }}</p>
    <p>Published on: {{ $article->published_at->format('Y-m-d') }}</p>
@endsection