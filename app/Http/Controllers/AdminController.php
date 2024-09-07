<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Models\Review;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_articles' => Article::count(),
            'total_users' => User::count(),
            'pending_reviews' => Review::where('status', 'pending')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}