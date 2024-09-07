@extends('layouts.app')

@section('content')
<h1>Submit New Article</h1>
<form action="{{ route('articles.store') }}" method="POST">
    @csrf
    <div>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
    </div>
    <div>
        <label for="abstract">Abstract:</label>
        <textarea id="abstract" name="abstract" required></textarea>
    </div>
    <div>
        <label for="content">Content:</label>
        <textarea id="content" name="content" required></textarea>
    </div>
    <button type="submit">Submit Article</button>
</form>
@endsection