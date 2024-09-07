@extends('layouts.app')

@section('content')
<h1>Issue: Volume {{ $issue->volume }}, Number {{ $issue->number }} ({{ $issue->year }})</h1>
<h2>{{ $issue->title }}</h2>

@if($issue->cover_image)
    <img src="{{ asset('storage/' . $issue->cover_image) }}" alt="Issue Cover">
@endif

<h3>Contents:</h3>
<ul>
    @foreach($issue->articles as $article)
        <li>
            <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
            by {{ $article->author->name }}
        </li>
    @endforeach
</ul>

<a href="{{ route('issues.pdf', $issue) }}">Download Full Issue PDF</a>
@endsection