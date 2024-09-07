@extends('layouts.app')

@section('content')
    <h1>Upload Article PDF</h1>
    <form action="{{ route('articles.submit.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="pdf_file" required>
        <button type="submit">Upload and Continue</button>
    </form>
@endsection