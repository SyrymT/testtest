<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'abstract' => 'required',
            'keywords' => 'required',
            'manuscript' => 'required|file|mimes:pdf|max:10240',
        ]);

        $filePath = $request->file('manuscript')->store('manuscripts');

        $article = Article::create([
            'title' => $validatedData['title'],
            'abstract' => $validatedData['abstract'],
            'keywords' => $validatedData['keywords'],
            'file_path' => $filePath,
        ]);

        return redirect()->route('articles.index')->with('success', 'Article submitted successfully');
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'abstract' => 'required',
            'keywords' => 'required',
        ]);

        $article->update($validatedData);

        return redirect()->route('articles.index')->with('success', 'Article updated successfully');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully');
    }
}