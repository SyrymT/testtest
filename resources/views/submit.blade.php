@extends('layouts.app')

@section('content')
    <h1>Submit Article</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('submit.handle') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="step" value="{{ $step }}">

        @if ($step == 1)
            <div>
                <label for="section_id">Section:</label>
                <select id="section_id" name="section_id" required>
                    @foreach($sections as $section)
                        <option value="{{ $section->id }}">{{ $section->title }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="locale">Language:</label>
                <select id="locale" name="locale" required>
                    <option value="en">English</option>
                    <option value="fr">French</option>
                    <!-- Add more languages as needed -->
                </select>
            </div>
            <div>
                <h3>Submission Checklist</h3>
                <ul>
                    <li>
                        <input type="checkbox" id="checklist1" name="checklist[]" value="1" required>
                        <label for="checklist1">The submission has not been previously published.</label>
                    </li>
                    <!-- Add more checklist items as needed -->
                </ul>
            </div>
        @elseif ($step == 2)
            <div>
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div>
                <label for="abstract">Abstract:</label>
                <textarea id="abstract" name="abstract" required></textarea>
            </div>
            <div>
                <label for="keywords">Keywords:</label>
                <input type="text" id="keywords" name="keywords" required>
            </div>
        @elseif ($step == 3)
            <div id="authors">
                <div class="author">
                    <h3>Author 1</h3>
                    <input type="text" name="authors[0][given_name]" placeholder="Given Name" required>
                    <input type="text" name="authors[0][family_name]" placeholder="Family Name" required>
                    <input type="email" name="authors[0][email]" placeholder="Email" required>
                    <input type="text" name="authors[0][affiliation]" placeholder="Affiliation" required>
                </div>
            </div>
            <button type="button" onclick="addAuthor()">Add Another Author</button>
        @elseif ($step == 4)
            <div>
                <label for="manuscript">Manuscript (PDF only):</label>
                <input type="file" id="manuscript" name="manuscript" accept=".pdf" required>
            </div>
        @elseif ($step == 5)
            <h2>Confirm Submission</h2>
            <p>Please review your submission. If everything is correct, click 'Submit' to finalize your submission.</p>
        @endif

        <button type="submit">
            @if ($step < 5)
                Next
            @else
                Submit
            @endif
        </button>
    </form>

    <script>
        let authorCount = 1;
        function addAuthor() {
            authorCount++;
            const authorsDiv = document.getElementById('authors');
            const newAuthorDiv = document.createElement('div');
            newAuthorDiv.className = 'author';
            newAuthorDiv.innerHTML = `
                <h3>Author ${authorCount}</h3>
                <input type="text" name="authors[${authorCount-1}][given_name]" placeholder="Given Name" required>
                <input type="text" name="authors[${authorCount-1}][family_name]" placeholder="Family Name" required>
                <input type="email" name="authors[${authorCount-1}][email]" placeholder="Email" required>
                <input type="text" name="authors[${authorCount-1}][affiliation]" placeholder="Affiliation" required>
            `;
            authorsDiv.appendChild(newAuthorDiv);
        }
    </script>
@endsection