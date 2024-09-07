<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Services\CopyscapeService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Smalot\PdfParser\Parser;

class ArticleSubmissionTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user);

        $this->mock(CopyscapeService::class, function ($mock) {
            $mock->shouldReceive('checkPlagiarism')->andReturn([
                'percentPlagiarized' => 10,
                'matchedWords' => 50,
                'totalWords' => 500,
            ]);
        });

        $this->mock(Parser::class, function ($mock) {
            $mock->shouldReceive('parseFile')->andReturn(new class {
                public function getText() {
                    return 'Sample PDF content';
                }
            });
        });
    }

    public function testMultiStepSubmissionForm()
    {
        // Step 1
        $response = $this->post(route('submit.handle'), [
            'step' => 1,
            'title' => 'Test Article',
            'abstract' => 'This is a test abstract',
        ]);

        $response->assertRedirect(route('submit.form', ['step' => 2]));

        // Step 2
        $response = $this->post(route('submit.handle'), [
            'step' => 2,
            'authors' => 'John Doe, Jane Smith',
            'keywords' => 'test, article, submission',
        ]);

        $response->assertRedirect(route('submit.form', ['step' => 3]));

        // Step 3
        Storage::fake('local');
        $file = UploadedFile::fake()->create('document.pdf', 1000, 'application/pdf');

        $response = $this->post(route('submit.handle'), [
            'step' => 3,
            'manuscript' => $file,
        ]);

        $response->assertRedirect(route('submit.form'));
        $response->assertSessionHas('success');

        // Assert the file was stored
        Storage::disk('local')->assertExists('manuscripts/' . $file->hashName());

        // Assert the article was created in the database
        $this->assertDatabaseHas('articles', [
            'title' => 'Test Article',
            'abstract' => 'This is a test abstract',
            'authors' => 'John Doe, Jane Smith',
            'keywords' => 'test, article, submission',
            'plagiarism_score' => 10,
        ]);
    }

    public function testInvalidStepRedirectsToFirstStep()
    {
        $response = $this->get(route('submit.form', ['step' => 4]));
        $response->assertRedirect(route('submit.form'));
    }

    public function testPlagiarismCheckFailure()
    {
        $this->mock(CopyscapeService::class, function ($mock) {
            $mock->shouldReceive('checkPlagiarism')->andReturn(false);
        });

        Storage::fake('local');
        $file = UploadedFile::fake()->create('document.pdf', 1000);

        $response = $this->post(route('submit.handle'), [
            'step' => 3,
            'manuscript' => $file,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Plagiarism check failed. Please try again later.');
    }

    public function testHighPlagiarismScore()
    {
        $this->mock(CopyscapeService::class, function ($mock) {
            $mock->shouldReceive('checkPlagiarism')->andReturn([
                'percentPlagiarized' => 30,
                'matchedWords' => 150,
                'totalWords' => 500,
            ]);
        });

        Storage::fake('local');
        $file = UploadedFile::fake()->create('document.pdf', 1000);

        $response = $this->post(route('submit.handle'), [
            'step' => 3,
            'manuscript' => $file,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error', 'High similarity detected. Please review your submission.');
    }

    public function testUserCanSubmitArticle()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/articles', [
            'title' => 'Test Article',
            'abstract' => 'This is a test abstract',
            'content' => 'This is the full content of the test article.',
        ]);

        $response->assertRedirect('/articles');
        $this->assertDatabaseHas('articles', ['title' => 'Test Article']);
    }
}