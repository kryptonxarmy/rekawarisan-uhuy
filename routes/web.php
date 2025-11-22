<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JejakMaestroController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\Admin\QuizAdminController;
use App\Http\Controllers\Admin\QuestionAdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
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
// JEJAK MAESTRO (ONLY USER LOGIN)
// ------------------------------------------------------
Route::middleware('auth')->group(function () {

    Route::get('/jejak-maestro', [JejakMaestroController::class, 'index'])->name('jejakmaestro');

    Route::post('/mission/complete/read',  [JejakMaestroController::class, 'completeRead'])->name('mission.complete.read');
    Route::post('/mission/complete/share', [JejakMaestroController::class, 'completeShare'])->name('mission.complete.share');
    Route::post('/mission/complete/quiz',  [JejakMaestroController::class, 'completeQuiz'])->name('mission.complete.quiz');

    Route::get('/reset-error-misi', [JejakMaestroController::class, 'resetMisiHariIni']);
});


// ------------------------------------------------------
// DASHBOARD & PROFILE
// ------------------------------------------------------
Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ------------------------------------------------------
// QUIZ FRONTEND (Tanpa Parameter di URL)
// ------------------------------------------------------
Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');
Route::get('/quiz/play', [QuizController::class, 'play']);
Route::post('/quiz/submit', [QuizController::class, 'submit'])->name('quiz.submit');



// ------------------------------------------------------
// QUIZIZZ ADMIN ROUTES (CRUD Quiz & Soal)
// ------------------------------------------------------
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // CRUD QUIZ
    Route::resource('quizzes', QuizAdminController::class);

    // CRUD SOAL PER QUIZ
    Route::get('quizzes/{quiz_id}/questions', [QuestionAdminController::class, 'index'])->name('questions.index');
    Route::get('quizzes/{quiz_id}/questions/create', [QuestionAdminController::class, 'create'])->name('questions.create');
    Route::post('quizzes/{quiz_id}/questions', [QuestionAdminController::class, 'store'])->name('questions.store');
    Route::get('quizzes/{quiz_id}/questions/{id}/edit', [QuestionAdminController::class, 'edit'])->name('questions.edit');
    Route::put('quizzes/{quiz_id}/questions/{id}', [QuestionAdminController::class, 'update'])->name('questions.update');
    Route::delete('quizzes/{quiz_id}/questions/{id}', [QuestionAdminController::class, 'destroy'])->name('questions.destroy');
});


require __DIR__ . '/auth.php';
