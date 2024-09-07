<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Section;
use App\Models\Author;
use App\Notifications\SubmissionReceived;
use App\Services\CopyscapeService;
use Smalot\PdfParser\Parser;

class SubmissionController extends Controller
{
    protected $copyscapeService;
    protected $pdfParser;

    public function __construct(CopyscapeService $copyscapeService, Parser $pdfParser)
    {
        $this->copyscapeService = $copyscapeService;
        $this->pdfParser = $pdfParser;
    }

    public function showForm(Request $request)
    {
        $step = $request->query('step', 1);
        $sections = Section::all();
        return view('submit', compact('step', 'sections'));
    }

    public function handleForm(Request $request)
    {
        $step = $request->input('step', 1);

        switch ($step) {
            case 1:
                return $this->handleStep1($request);
            case 2:
                return $this->handleStep2($request);
            case 3:
                return $this->handleStep3($request);
            case 4:
                return $this->handleStep4($request);
            case 5:
                return $this->handleStep5($request);
            default:
                return redirect()->route('submit.form')->with('error', 'Invalid step');
        }
    }

    private function handleStep1(Request $request)
    {
        $validatedData = $request->validate([
            'section_id' => 'required|exists:sections,id',
            'locale' => 'required|string',
            'checklist' => 'required|array',
        ]);

        $request->session()->put('submission_data', $validatedData);
        return redirect()->route('submit.form', ['step' => 2]);
    }

    private function handleStep2(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'abstract' => 'required|string',
            'keywords' => 'required|string',
        ]);

        $submissionData = $request->session()->get('submission_data', []);
        $submissionData = array_merge($submissionData, $validatedData);
        $request->session()->put('submission_data', $submissionData);

        return redirect()->route('submit.form', ['step' => 3]);
    }

    private function handleStep3(Request $request)
    {
        $validatedData = $request->validate([
            'authors' => 'required|array',
            'authors.*.given_name' => 'required|string',
            'authors.*.family_name' => 'required|string',
            'authors.*.email' => 'required|email',
            'authors.*.affiliation' => 'required|string',
        ]);

        $submissionData = $request->session()->get('submission_data', []);
        $submissionData['authors'] = $validatedData['authors'];
        $request->session()->put('submission_data', $submissionData);

        return redirect()->route('submit.form', ['step' => 4]);
    }

    private function handleStep4(Request $request)
    {
        $validatedData = $request->validate([
            'manuscript' => 'required|file|mimes:pdf|max:10240',
        ]);

        $submissionData = $request->session()->get('submission_data', []);

        $file = $request->file('manuscript');
        $filePath = $file->store('manuscripts');

        // Extract text from the PDF file
        $text = $this->extractTextFromPdf($file);

        // Check for plagiarism
        $plagiarismResult = $this->copyscapeService->checkPlagiarism($text);

        if ($plagiarismResult === false) {
            return redirect()->back()->with('error', 'Plagiarism check failed. Please try again later.');
        }

        if ($plagiarismResult['percentPlagiarized'] > 20) {
            return redirect()->back()->with('error', 'High similarity detected. Please review your submission.');
        }

        $submissionData['file_path'] = $filePath;
        $submissionData['plagiarism_score'] = $plagiarismResult['percentPlagiarized'];
        $request->session()->put('submission_data', $submissionData);

        return redirect()->route('submit.form', ['step' => 5]);
    }

    private function handleStep5(Request $request)
    {
        $submissionData = $request->session()->get('submission_data', []);

        $article = Article::create([
            'title' => $submissionData['title'],
            'abstract' => $submissionData['abstract'],
            'keywords' => $submissionData['keywords'],
            'file_path' => $submissionData['file_path'],
            'plagiarism_score' => $submissionData['plagiarism_score'],
            'section_id' => $submissionData['section_id'],
            'locale' => $submissionData['locale'],
        ]);

        foreach ($submissionData['authors'] as $authorData) {
            $author = new Author($authorData);
            $article->authors()->save($author);
        }

        // Send notification
        $user = auth()->user();
        $user->notify(new SubmissionReceived($article));

        $request->session()->forget('submission_data');

        return redirect()->route('submit.form')->with('success', 'Article submitted successfully!');
    }

    private function extractTextFromPdf($file)
    {
        try {
            $pdf = $this->pdfParser->parseFile($file->path());
            return $pdf->getText();
        } catch (\Exception $e) {
            \Log::error('PDF parsing failed: ' . $e->getMessage());
            return '';
        }
    }
}