<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JejakMaestroController; // Penting: Pastikan Controller ini sudah ada file-nya
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes (Halaman Publik)
|--------------------------------------------------------------------------
*/

// --- HOMEPAGE ---
Route::get('/', function () {
    return view('frontend.beranda');
})->name('beranda');

// --- HALAMAN INFO ---
Route::get('/faq', function () {
    return view('frontend.page.faq');
})->name('faq');

Route::get('/kebijakan-privasi', function () {
    return view('frontend.page.kebijakan');
})->name('kebijakan-privasi');

Route::get('/contact', function () {
    return view('frontend.page.contact');
})->name('contact');

// --- PUSTAKA WARISAN (Punyamu) ---
Route::get('/pustaka-warisan', function () {
    return view('frontend.pustakawarisan.index');
})->name('pustakawarisan');

Route::get('/pustaka-warisan/detail', function () {
    return view('frontend.pustakawarisan.detail');
})->name('pustakawarisan.detail');

// --- ERROR PAGES (Punyamu) ---
Route::get('/200', fn () => view('frontend.errors.200'))->name('200');
Route::get('/400', fn () => view('frontend.errors.400'))->name('400');
Route::get('/404', fn () => view('frontend.errors.404'))->name('404');
Route::get('/500', fn () => view('frontend.errors.500'))->name('500');

/*
|--------------------------------------------------------------------------
| Routes yang Membutuhkan Login (Middleware Auth)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    
    // --- DASHBOARD ---
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // --- JEJAK MAESTRO LOGIC (Dari Temanmu) ---
    // Menggunakan Controller agar fungsi misi, share, dan kuis berjalan
    
    // Halaman Utama Jejak Maestro
    Route::get('/jejak-maestro', [JejakMaestroController::class, 'index'])->name('jejakmaestro');

    // Action Misi (Post ke Controller)
    Route::post('/mission/complete/read', [JejakMaestroController::class, 'completeRead'])->name('mission.complete.read');
    Route::post('/mission/complete/share', [JejakMaestroController::class, 'completeShare'])->name('mission.complete.share');
    Route::post('/mission/complete/quiz', [JejakMaestroController::class, 'completeQuiz'])->name('mission.complete.quiz');

    // Reset Darurat (Hapus jika sudah production/live)
    Route::get('/reset-error-misi', [JejakMaestroController::class, 'resetMisiHariIni']);
});

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';