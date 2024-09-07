<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EditorialDecision;
use App\Models\Article;

class EditorialDecisionController extends Controller
{
    public function makeDecision(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'decision' => 'required|in:accepted,rejected,revisions_required',
            'comments' => 'nullable|string',
        ]);

        EditorialDecision::create([
            'article_id' => $request->input('article_id'),
            'decision' => $request->input('decision'),
            'comments' => $request->input('comments'),
        ]);

        return redirect()->back()->with('success', 'Decision recorded successfully!');
    }
}