<!DOCTYPE html>
<html>
<head>
    <title>Make Editorial Decision</title>
</head>
<body>
    <form method="POST" action="/make-decision">
        @csrf
        <input type="hidden" name="article_id" value="{{ $article_id }}">
        <select name="decision" required>
            <option value="accepted">Accept</option>
            <option value="rejected">Reject</option>
            <option value="revisions_required">Revisions Required</option>
        </select>
        <textarea name="comments" placeholder="Enter your comments"></textarea>
        <button type="submit">Submit Decision</button>
    </form>
</body>
</html>