<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JejakMaestroController; // Pastikan ini ada
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

// --- JEJAK MAESTRO (Hanya User Login) ---
Route::middleware('auth')->group(function () {

    // Halaman Utama
    Route::get('/jejak-maestro', [JejakMaestroController::class, 'index'])->name('jejakmaestro');

    // Route Action Misi (SEMUA KE JejakMaestroController)
    Route::post('/mission/complete/read', [JejakMaestroController::class, 'completeRead'])->name('mission.complete.read');
    Route::post('/mission/complete/share', [JejakMaestroController::class, 'completeShare'])->name('mission.complete.share');
    Route::post('/mission/complete/quiz', [JejakMaestroController::class, 'completeQuiz'])->name('mission.complete.quiz');

    // --- ROUTE RESET DARURAT (HAPUS NANTI KALAU SUDAH LIVE) ---
    // Akses ini sekali saja lewat browser untuk memperbaiki data "130 Poin"
    Route::get('/reset-error-misi', [JejakMaestroController::class, 'resetMisiHariIni']);
});

// --- DASHBOARD & PROFILE ---
Route::get('/dashboard', function () { return view('dashboard'); })->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';