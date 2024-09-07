@extends('layouts.app')

@section('content')
    <h1>Submit an Article</h1>
    <p>Start your submission process here.</p>
    <a href="{{ route('articles.submit.upload') }}" class="btn btn-primary">Start Submission</a>
@endsection