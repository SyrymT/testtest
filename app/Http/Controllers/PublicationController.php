<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PublishedArticle;
use App\Models\Article;
use App\Services\CrossrefService;
use Carbon\Carbon;

class PublicationController extends Controller
{
    protected $crossrefService;

    public function __construct(CrossrefService $crossrefService)
    {
        $this->crossrefService = $crossrefService;
    }

    public function publishArticle(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id',
        ]);

        $article = Article::find($request->input('article_id'));
        $doi = $this->crossrefService->assignDoi($article);

        if ($doi) {
            PublishedArticle::create([
                'article_id' => $article->id,
                'doi' => $doi,
                'published_at' => Carbon::now(),
            ]);

            return redirect()->back()->with('success', 'Article published successfully with DOI: ' . $doi);
        }

        return redirect()->back()->with('error', 'Failed to assign DOI');
    }

    public function showPublishedArticles()
    {
        $publishedArticles = PublishedArticle::with('article')->get();
        return view('published_articles', compact('publishedArticles'));
    }
}