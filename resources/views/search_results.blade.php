@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
    <h1>Search Results for "{{ $query }}"</h1>
    <ul>
        @forelse($results as $article)
            <li>
                <h2>{{ $article->article->title }}</h2>
                <p>{{ $article->article->abstract }}</p>
                <p>DOI: {{ $article->doi }}</p>
                <p>Published on: {{ $article->published_at->format('Y-m-d') }}</p>
            </li>
        @empty
            <li>No articles found.</li>
        @endforelse
    </ul>
@endsection