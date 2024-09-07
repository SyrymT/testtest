@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
    <h1>Notifications</h1>
    <ul>
        @foreach(auth()->user()->notifications as $notification)
            <li>
                <a href="{{ $notification->data['url'] }}">
                    {{ $notification->data['message'] }}
                </a>
            </li>
        @endforeach
    </ul>
@endsection