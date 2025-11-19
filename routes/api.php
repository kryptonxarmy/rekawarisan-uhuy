<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JejakMaestroController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () { return view('frontend.beranda'); })->name('beranda');
Route::get('/faq', function () { return view('frontend.page.faq'); })->name('faq');
Route::get('/kebijakan-privasi', function () { return view('frontend.page.kebijakan'); })->name('kebijakan-privasi');
Route::get('/contact', function () { return view('frontend.page.contact'); })->name('contact');

// =====================================
// JEJAK MAESTRO (Hanya untuk user login)
// =====================================
Route::middleware('auth')->group(function () {

    Route::get('/jejak-maestro', [JejakMaestroController::class, 'index'])
        ->name('jejakmaestro');

    // Misi harian
    Route::post('/mission/complete/read',  [JejakMaestroController::class, 'completeRead'])
        ->name('mission.complete.read');
    Route::post('/mission/complete/share', [JejakMaestroController::class, 'completeShare'])
        ->name('mission.complete.share');
    Route::post('/mission/complete/quiz',  [JejakMaestroController::class, 'completeQuiz'])
        ->name('mission.complete.quiz');

    // Reset misi darurat
    Route::get('/reset-error-misi', [JejakMaestroController::class, 'resetMisiHariIni']);
});


// =====================================
// Dashboard & Profile
// =====================================
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile',   [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
