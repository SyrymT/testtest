<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $articles = Article::where('title', 'like', "%$query%")
                           ->orWhere('abstract', 'like', "%$query%")
                           ->orWhere('keywords', 'like', "%$query%")
                           ->paginate(10);

        return view('search.results', compact('articles', 'query'));
    }
}