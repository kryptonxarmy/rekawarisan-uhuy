<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JejakMaestroController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\Admin\QuizAdminController;
use App\Http\Controllers\Admin\QuestionAdminController;

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\FaktaCepatController;

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes (Halaman Publik)
|--------------------------------------------------------------------------
*/

// ------------------------------------------------------
// LANDING PAGE
// ------------------------------------------------------
Route::get('/', fn() => view('frontend.beranda'))->name('beranda');
Route::get('/faq', fn() => view('frontend.page.faq'))->name('faq');
Route::get('/kebijakan-privasi', fn() => view('frontend.page.kebijakan'))->name('kebijakan-privasi');
Route::get('/contact', fn() => view('frontend.page.contact'))->name('contact');


// ------------------------------------------------------
// PUSTAKA WARISAN (From pino)
// ------------------------------------------------------

Route::get('/pustaka-warisan', [ArticleController::class, 'index'])->name('pustakawarisan.index');

Route::get('/pustaka-warisan/detail', function () {
    return view('frontend.pustakawarisan.detail');
})->name('pustakawarisan.detail');

Route::middleware(['auth', 'points:150'])->group(function () {
    Route::get('/pustaka-warisan/create', [ArticleController::class, 'create'])->name('pustakawarisan.create');
    Route::post('/pustaka-warisan', [ArticleController::class, 'store'])->name('pustakawarisan.store');

    Route::post('/pustaka-warisan/upload-image', [ArticleController::class, 'uploadImage'])
        ->name('pustakawarisan.upload_image');
});

Route::prefix('pustaka-warisan')->group(function () {

    // CRUD Resource
    Route::resource('/', ArticleController::class)
        ->parameters(['' => 'article'])
        ->names('articles');

    Route::get('/', [ArticleController::class, 'index'])->name('pustakawarisan.index');
    Route::get('/create', [ArticleController::class, 'create'])->name('pustakawarisan.create');

    Route::post('/upload-image', [ArticleController::class, 'uploadImage'])
        ->name('articles.uploadImage')
        ->middleware('auth');

    Route::post('/{id}/like', [ArticleController::class, 'like'])
        ->name('articles.like')
        ->middleware('auth');

    Route::post('/{id}/comment', [ArticleController::class, 'comment'])
        ->name('articles.comment')
        ->middleware('auth');
});

Route::get('/pustaka-warisan/detail/{id}', [ArticleController::class, 'show'])
    ->name('pustakawarisan.detail');

Route::get('/pustaka-warisan/{slug}', [ArticleController::class, 'show'])
    ->name('pustakawarisan.show');


// ------------------------------------------------------
// JEJAK MAESTRO
// ------------------------------------------------------
Route::get('/jejak-maestro', [JejakMaestroController::class, 'index'])->name('jejakmaestro');

// JEJAK MAESTRO ACTIONS (Auth + Verified)
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    Route::post('/mission/complete/read', [JejakMaestroController::class, 'completeRead'])->name('mission.complete.read');
    Route::post('/mission/complete/share', [JejakMaestroController::class, 'completeShare'])->name('mission.complete.share');
    Route::post('/mission/complete/quiz',  [JejakMaestroController::class, 'completeQuiz'])->name('mission.complete.quiz');

    // Reset Misi (untuk debugging)
    Route::get('/reset-error-misi', [JejakMaestroController::class, 'resetMisiHariIni']);
});


// ------------------------------------------------------
// PROFILE
// ------------------------------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ------------------------------------------------------
// QUIZ FRONTEND
// ------------------------------------------------------
Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');
// ------------------------------------------------------
// AUTH ROUTES
// ------------------------------------------------------
require __DIR__.'/auth.php';

