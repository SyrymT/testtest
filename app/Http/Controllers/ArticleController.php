public function show(Article $article)
{
    return view('articles.show', compact('article'));
}