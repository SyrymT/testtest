<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleSubmissionController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');

    Route::resource('articles', ArticleController::class);
    Route::get('/submit-article', [SubmissionController::class, 'create'])->name('submit.article');
    Route::post('/submit-article', [SubmissionController::class, 'store']);

    Route::get('/review', [ReviewController::class, 'index'])->name('review.index');
});

Auth::routes(['verify' => true]);

Route::middleware(['auth'])->group(function () {
    Route::get('/articles/submit', [ArticleSubmissionController::class, 'start'])->name('articles.submit.start');
    Route::post('/articles/submit/upload', [ArticleSubmissionController::class, 'uploadMaterial'])->name('articles.submit.upload');
    Route::post('/articles/submit/metadata', [ArticleSubmissionController::class, 'enterMetadata'])->name('articles.submit.metadata');
    Route::get('/articles/submit/{article}/complete', [ArticleSubmissionController::class, 'complete'])->name('articles.submit.complete');
    
    Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
});
