<!DOCTYPE html>
<html>
<head>
    <title>Submit Review</title>
</head>
<body>
    <form method="POST" action="/submit-review">
        @csrf
        <input type="hidden" name="assignment_id" value="{{ $assignment_id }}">
        <textarea name="comments" placeholder="Enter your review comments" required></textarea>
        <button type="submit">Submit Review</button>
    </form>
</body>
</html>