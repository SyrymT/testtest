@extends('layouts.app')

@section('title', 'Search Articles')

@section('content')
    <h1>Search Articles</h1>
    <form method="POST" action="/search">
        @csrf
        <input type="text" name="query" placeholder="Enter search term" required>
        <button type="submit">Search</button>
    </form>
@endsection