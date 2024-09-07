<!DOCTYPE html>
<html>
<head>
    <title>Publish Article</title>
</head>
<body>
    <form method="POST" action="/publish-article">
        @csrf
        <input type="hidden" name="article_id" value="{{ $article_id }}">
        <input type="text" name="doi" placeholder="Enter DOI" required>
        <button type="submit">Publish Article</button>
    </form>
</body>
</html>