<?php

use Illuminate\Support\Facades\Route;

// --- CONTROLLERS FRONTEND ---
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\JejakMaestroController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\Admin\ContactController;

// --- CONTROLLERS ADMIN ---
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\DailyMissionController as AdminDailyMissionController;
use App\Http\Controllers\Admin\ArticleCategoryController;
use App\Http\Controllers\Admin\FaktaCepatController as AdminFaktaCepatController;
use App\Http\Controllers\Admin\LeaderboardController;
use App\Http\Controllers\Admin\BadgeController;
use App\Http\Controllers\AuthController; // Jika pakai custom auth controller

/*
|--------------------------------------------------------------------------
| Web Routes (Halaman Publik & User)
|--------------------------------------------------------------------------
*/

// 1. LANDING PAGE & HALAMAN STATIS
Route::get('/', fn() => view('frontend.beranda'))->name('beranda');
Route::get('/faq', fn() => view('frontend.page.faq'))->name('faq');
Route::get('/kebijakan-privasi', fn() => view('frontend.page.kebijakan'))->name('kebijakan-privasi');
Route::get('/contact', fn() => view('frontend.page.contact'))->name('contact');
Route::post('/kontak', [ContactController::class, 'store'])->name('contacts.store');


// 2. PUSTAKA WARISAN (ARTIKEL)
Route::get('/pustaka-warisan', [ArticleController::class, 'index'])->name('pustakawarisan.index');


// Aksi User di Artikel (Butuh Login)
Route::middleware(['auth'])->group(function () {
    // Create Artikel (Syarat Poin 150 - Opsional jika mau diaktifkan lagi, uncomment middleware points)
    // Route::middleware('points:150')->group(function() { ... });
    
    // TANPA AUTH
    Route::get('/pustaka-warisan/create', [ArticleController::class, 'create'])
        ->name('pustakawarisan.create');

    Route::post('/pustaka-warisan', [ArticleController::class, 'store'])->name('pustakawarisan.store');
    Route::post('/pustaka-warisan/upload-image', [ArticleController::class, 'uploadImage'])->name('pustakawarisan.upload_image');

    // Like & Comment
    Route::post('/pustaka-warisan/{id}/like', [ArticleController::class, 'like'])->name('articles.like');
    Route::post('/pustaka-warisan/{id}/comment', [ArticleController::class, 'comment'])->name('articles.comment');
});

Route::get('/pustaka-warisan/detail/{id}', [ArticleController::class, 'show'])->name('pustakawarisan.detail');
Route::get('/pustaka-warisan/{slug}', [ArticleController::class, 'show'])->name('pustakawarisan.show');

// 3. JEJAK MAESTRO (MISI HARIAN & GAMIFIKASI)
// Halaman Utama Jejak Maestro

Route::get('/jejak-maestro', [JejakMaestroController::class, 'index'])->name('jejakmaestro');

// Aksi Misi (Login & Verified)
Route::middleware(['auth', 'verified'])->group(function () {
    
    // --- AKSI SELESAIKAN MISI ---
    // Misi Baca
    Route::post('/jejak-maestro/complete-read', [JejakMaestroController::class, 'completeRead'])->name('mission.complete.read');
    // Misi Share
    Route::post('/jejak-maestro/complete-share', [JejakMaestroController::class, 'completeShare'])->name('mission.complete.share');
    // Misi Kuis (Simpan Skor)
    Route::post('/jejak-maestro/complete-quiz', [JejakMaestroController::class, 'completeQuiz'])->name('mission.complete.quiz');

    // --- QUIZ PLAYER (GAMEPLAY) ---
    // Route ini dipanggil saat tombol "Kerjakan Kuis" diklik
    // Menggunakan QuizController untuk logika permainan, tapi JejakMaestroController untuk simpan data
    Route::get('/quiz/play', [QuizController::class, 'play'])->name('quiz.play');

    // Route Dashboard User (Opsional, jika ada dashboard terpisah)
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); 
    })->name('dashboard');
});


// 4. PROFILE USER
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Login Admin Khusus (Jika terpisah)
Route::get('admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'login']);
Route::post('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Group Admin
Route::prefix('admin')->middleware(['auth'])->as('admin.')->group(function () { // Tambahkan middleware admin jika ada role check

    // Dashboard Admin
    Route::get('/dashboard', function () { return view('admin.dashboard'); })->name('dashboard');
    Route::get('/', function () { return redirect()->route('admin.dashboard'); })->name('home');

    // Kelola Artikel (Pustaka Warisan)
    Route::resource('articles', AdminArticleController::class)->names('articles');
    Route::post('articles/{article}/approve', [AdminArticleController::class, 'approve'])->name('articles.approve');
    Route::post('articles/{article}/reject', [AdminArticleController::class, 'reject'])->name('articles.reject');

    // Kategori Artikel
    Route::resource('categories', ArticleCategoryController::class)->names('categories');

    // Daily Missions (Misi Harian - New System)
    Route::resource('daily-missions', AdminDailyMissionController::class)->names([
        'index' => 'daily-missions.index',
        'create' => 'daily-missions.create',
        'store' => 'daily-missions.store',
        'show' => 'daily-missions.show',
        'edit' => 'daily-missions.edit',
        'update' => 'daily-missions.update',
        'destroy' => 'daily-missions.destroy'
    ])->parameters(['daily-missions' => 'dailyMission']);

    // Fakta Cepat
    Route::resource('fakta-cepat', AdminFaktaCepatController::class)->names('fakta-cepat');
    Route::post('fakta-cepat/{faktaCepat}/approve', [AdminFaktaCepatController::class, 'approve'])->name('fakta-cepat.approve');
    Route::post('fakta-cepat/{faktaCepat}/reject', [AdminFaktaCepatController::class, 'reject'])->name('fakta-cepat.reject');

    // Leaderboard & Badge Management
    Route::resource('leaderboard', LeaderboardController::class)->only(['index']);
    Route::resource('badges', BadgeController::class)->names('badges');

    // Inbox / Kontak
    Route::resource('inbox', ContactController::class)->only(['index', 'show', 'destroy'])->names('inbox');
    Route::post('inbox/{message}/mark-read', [ContactController::class, 'markAsRead'])->name('inbox.mark-read');
});

require __DIR__.'/auth.php';