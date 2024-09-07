@extends('layouts.app')

@section('title', 'Profile - Uly Dala Journal')

@section('content')
<div class="container">
    <h1>User Profile</h1>
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')
        <!-- Add form fields for user profile here -->
        <button type="submit">Update Profile</button>
    </form>
</div>
@endsection