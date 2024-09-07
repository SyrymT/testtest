@extends('layouts.app')

@section('content')
    <h1>Confirm Submission</h1>
    <p>Please review your submission:</p>
    <h2>{{ $article->title }}</h2>
    <p>{{ $article->abstract }}</p>
    <p>Keywords: {{ $article->keywords }}</p>
    <a href="{{ route('articles.submit.complete', $article) }}" class="btn btn-primary">Confirm and Submit</a>
@endsection