@extends('layouts.app')

@section('title', 'Dashboard - Uly Dala Journal')

@section('content')
<div class="container">
    <h1>User Dashboard</h1>
    <p>Welcome, {{ Auth::user()->name }}!</p>
    <!-- Add dashboard content here -->
</div>
@endsection