@extends('layouts.app')

@section('title', 'Current Issue')

@section('content')
    <h1>Current Issue</h1>
    <ul>
        @foreach($currentIssue as $article)
            <li>
                <h2>{{ $article->article->title }}</h2>
                <p>{{ $article->article->abstract }}</p>
                <p>DOI: {{ $article->doi }}</p>
                <p>Published on: {{ $article->published_at->format('Y-m-d') }}</p>
            </li>
        @endforeach
    </ul>
@endsection