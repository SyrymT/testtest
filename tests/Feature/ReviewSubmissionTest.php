<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Article;
use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReviewSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function testReviewerCanSubmitReview()
    {
        $reviewer = User::factory()->create(['role' => 'reviewer']);
        $article = Article::factory()->create();

        $response = $this->actingAs($reviewer)->post(route('reviews.submit', $article->id), [
            'comments' => 'This is a good article.',
            'recommendation' => 'accept',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('reviews', [
            'article_id' => $article->id,
            'reviewer_id' => $reviewer->id,
            'comments' => 'This is a good article.',
            'recommendation' => 'accept',
        ]);
    }
}