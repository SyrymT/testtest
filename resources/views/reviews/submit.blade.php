@extends('layouts.app')

@section('content')
<h1>Submit Review for: {{ $article->title }}</h1>
<form action="{{ route('reviews.submit', $article) }}" method="POST">
    @csrf
    <div>
        <label for="comments">Comments:</label>
        <textarea id="comments" name="comments" required></textarea>
    </div>
    <div>
        <label for="recommendation">Recommendation:</label>
        <select id="recommendation" name="recommendation" required>
            <option value="accept">Accept</option>
            <option value="revise">Revise</option>
            <option value="reject">Reject</option>
        </select>
    </div>
    <button type="submit">Submit Review</button>
</form>
@endsection