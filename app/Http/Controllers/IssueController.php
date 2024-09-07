<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function index()
    {
        $issues = Issue::all();
        return view('issues.index', compact('issues'));
    }

    public function create()
    {
        return view('issues.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'volume' => 'required|integer',
            'number' => 'required|integer',
            'year' => 'required|integer',
            'title' => 'required|max:255',
            'cover_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            $validatedData['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        Issue::create($validatedData);

        return redirect()->route('issues.index')->with('success', 'Issue created successfully');
    }

    public function show(Issue $issue)
    {
        return view('issues.show', compact('issue'));
    }

    public function generatePdf(Issue $issue)
    {
        // Implement PDF generation logic here
        // This is a placeholder and needs to be implemented based on your specific requirements
        $pdf = PDF::loadView('issues.pdf', compact('issue'));
        return $pdf->download('issue-' . $issue->volume . '-' . $issue->number . '.pdf');
    }
}