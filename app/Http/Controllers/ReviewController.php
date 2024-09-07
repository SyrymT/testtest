<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function assignReviewer(Request $request, Article $article)
    {
        $validatedData = $request->validate([
            'reviewer_id' => 'required|exists:users,id',
        ]);

        $article->reviewers()->attach($validatedData['reviewer_id']);

        return redirect()->back()->with('success', 'Reviewer assigned successfully');
    }

    public function submitReview(Request $request, Article $article)
    {
        $validatedData = $request->validate([
            'comments' => 'required',
            'recommendation' => 'required|in:accept,revise,reject',
        ]);

        $review = new Review($validatedData);
        $review->article_id = $article->id;
        $review->reviewer_id = auth()->id();
        $review->save();

        return redirect()->route('articles.show', $article)->with('success', 'Review submitted successfully');
    }
}