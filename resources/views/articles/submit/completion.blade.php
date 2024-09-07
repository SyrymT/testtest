@extends('layouts.app')

@section('content')
    <h1>Submission Complete</h1>
    <p>Thank you for your submission. Your article has been received and will be reviewed.</p>
    <a href="{{ route('home') }}" class="btn btn-primary">Return to Home</a>
@endsection