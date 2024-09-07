<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleSubmissionController extends Controller
{
    public function start()
    {
        return view('articles.submit.start');
    }

    public function uploadMaterial(Request $request)
    {
        // Handle file upload
        $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:10000',
        ]);

        $path = $request->file('pdf_file')->store('articles');

        return view('articles.submit.metadata', ['pdf_path' => $path]);
    }

    public function enterMetadata(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'abstract' => 'required',
            'keywords' => 'required',
            'pdf_path' => 'required',
        ]);

        $article = new Article($validatedData);
        $article->status = 'draft';
        $article->save();

        return view('articles.submit.confirmation', ['article' => $article]);
    }

    public function complete(Article $article)
    {
        $article->status = 'submitted';
        $article->save();

        return view('articles.submit.completion', ['article' => $article]);
    }
}