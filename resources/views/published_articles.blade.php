<!DOCTYPE html>
<html>
<head>
    <title>Published Articles</title>
</head>
<body>
    <h1>Published Articles</h1>
    <ul>
        @foreach($publishedArticles as $publishedArticle)
            <li>
                <h2>{{ $publishedArticle->article->title }}</h2>
                <p>{{ $publishedArticle->article->abstract }}</p>
                <p>DOI: {{ $publishedArticle->doi }}</p>
                <p>Published on: {{ $publishedArticle->published_at->format('Y-m-d') }}</p>
            </li>
        @endforeach
    </ul>
</body>
</html>