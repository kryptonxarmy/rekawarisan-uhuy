<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JejakMaestroController;
use App\Http\Controllers\ArticleController;
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

// Articles (user submissions)
Route::middleware(['auth', 'points:150'])->group(function () {
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');

    // WYSIWYG image upload endpoint (used by Trix)
    Route::post('/articles/upload-image', [ArticleController::class, 'uploadImage'])
        ->name('articles.upload_image');
});

// Public article view (placed after specific routes so '/articles/create' isn't captured as a slug)
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// --- ERROR PAGES (Punyamu) ---
Route::get('/200', fn () => view('frontend.errors.200'))->name('200');
Route::get('/400', fn () => view('frontend.errors.400'))->name('400');
Route::get('/404', fn () => view('frontend.errors.404'))->name('404');
Route::get('/500', fn () => view('frontend.errors.500'))->name('500');

// Halaman Utama Jejak Maestro - CUKUP DEKLARASI SATU KALI SAJA.
// Controller kini akan menangani penentuan view (login/belum login).
Route::get('/jejak-maestro', [JejakMaestroController::class, 'index'])->name('jejakmaestro');


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