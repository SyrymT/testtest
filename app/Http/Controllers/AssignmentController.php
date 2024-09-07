<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Article;
use App\Models\Reviewer;
use App\Notifications\ReviewAssigned;

class AssignmentController extends Controller
{
    public function assignReviewer(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'reviewer_id' => 'required|exists:reviewers,id',
        ]);

        $assignment = Assignment::create([
            'article_id' => $request->input('article_id'),
            'reviewer_id' => $request->input('reviewer_id'),
        ]);

        // Send notification
        $reviewer = Reviewer::find($request->input('reviewer_id'));
        $reviewer->notify(new ReviewAssigned());

        return redirect()->back()->with('success', 'Reviewer assigned successfully!');
    }
}