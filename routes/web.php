<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JejakMaestroController;
use App\Http\Controllers\FaktaCepatController;
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

// --- PUSTAKA WARISAN ---
// Hapus Route Closure yang duplikat. Hanya gunakan Controller.
Route::get('/pustaka-warisan', [ArticleController::class, 'index'])->name('pustakawarisan.index');

Route::get('/pustaka-warisan/detail', function () {
    // Catatan: Sebaiknya ini juga diarahkan ke Controller (ArticleController@show)
    return view('frontend.pustakawarisan.detail');
})->name('pustakawarisan.detail');

// Articles (user submissions)
Route::middleware(['auth', 'points:150'])->group(function () {
    Route::get('/pustaka-warisan/create', [ArticleController::class, 'create'])->name('pustakawarisan.create');
    Route::post('/pustaka-warisan', [ArticleController::class, 'store'])->name('pustakawarisan.store');

    // WYSIWYG image upload endpoint (used by Trix)
    Route::post('/pustaka-warisan/upload-image', [ArticleController::class, 'uploadImage'])
        ->name('pustakawarisan.upload_image');
});


// Semua rute di bawah ini akan diawali dengan '/pustaka-warisan'
Route::prefix('pustaka-warisan')->group(function () {

    // 1. RESOURCE ROUTE (Menyelesaikan Route [articles.store] not defined)
    // Mendefinisikan 7 rute standar CRUD, termasuk articles.store.
    Route::resource('/', ArticleController::class)
        ->parameters(['' => 'article']) 
        ->names('articles');            

    // 2. KUSTOMISASI NAMA ROUTE
    // Memastikan nama 'pustakawarisan.index' dan 'pustakawarisan.create' tetap tersedia
    Route::get('/', [ArticleController::class, 'index'])->name('pustakawarisan.index');
    Route::get('/create', [ArticleController::class, 'create'])->name('pustakawarisan.create');


    // 3. ROUTE KUSTOM UNTUK FUNGSI TAMBAHAN
    // Route yang digunakan oleh WYSIWYG editor untuk mengunggah gambar.
    Route::post('/upload-image', [ArticleController::class, 'uploadImage'])
        ->name('articles.uploadImage')
        ->middleware('auth');

    // Route untuk Like dan Komentar
    Route::post('/{id}/like', [ArticleController::class, 'like'])
        ->name('articles.like')
        ->middleware('auth');

    Route::post('/{id}/comment', [ArticleController::class, 'comment'])
        ->name('articles.comment')
        ->middleware('auth');
});

Route::get('/pustaka-warisan/detail/{id}', [ArticleController::class, 'show'])
    ->name('pustakawarisan.detail');


// Public article view (placed after specific routes so '/articles/create' isn't captured as a slug)
// Ganti slug menjadi ID jika Anda menggunakan ID, atau gunakan slug di DB.
// Jika di Controller Anda menggunakan Article::findOrFail($id), maka route ini harusnya:
// Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show'); 
// Saya pertahankan {slug} sesuai file lama, tapi periksa Controller Anda.
Route::get('/pustaka-warisan/{slug}', [ArticleController::class, 'show'])->name('pustakawarisan.show');


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
        return view('admin.dashboard');
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

// ARTIKEL
// Enduser
Route::resource('articles', ArticleController::class);

// Admin
Route::prefix('admin')->middleware('auth')->as('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () { return view('admin.dashboard'); })->name('dashboard');
    // Redirect /admin -> /admin/dashboard
    Route::get('/', function () { return redirect()->route('admin.dashboard'); })->name('home');

    // Kelola Pustaka
    Route::resource('articles', App\Http\Controllers\Admin\ArticleController::class)->names('articles');
    Route::post('articles/{article}/approve', [App\Http\Controllers\Admin\ArticleController::class, 'approve'])->name('articles.approve');
    Route::post('articles/{article}/reject', [App\Http\Controllers\Admin\ArticleController::class, 'reject'])->name('articles.reject');

    // Kategori Warisan
    Route::resource('categories', App\Http\Controllers\Admin\ArticleCategoryController::class)->names('categories');

    // Jejak Maestro (Old System)
    Route::resource('missions', App\Http\Controllers\Admin\MissionController::class)->names('missions');

    // Daily Missions (New System)
    Route::resource('daily-missions', App\Http\Controllers\Admin\DailyMissionController::class)->names([
        'index' => 'daily-missions.index',
        'create' => 'daily-missions.create',
        'store' => 'daily-missions.store',
        'show' => 'daily-missions.show',
        'edit' => 'daily-missions.edit',
        'update' => 'daily-missions.update',
        'destroy' => 'daily-missions.destroy'
    ])->parameters(['daily-missions' => 'dailyMission']);

    // Fakta Cepat
    Route::resource('fakta-cepat', App\Http\Controllers\Admin\FaktaCepatController::class)->names('fakta-cepat');
    Route::post('fakta-cepat/{faktaCepat}/approve', [App\Http\Controllers\Admin\FaktaCepatController::class, 'approve'])->name('fakta-cepat.approve');
    Route::post('fakta-cepat/{faktaCepat}/reject', [App\Http\Controllers\Admin\FaktaCepatController::class, 'reject'])->name('fakta-cepat.reject');

    // Leaderboard & Badges
    Route::resource('leaderboard', App\Http\Controllers\Admin\LeaderboardController::class)->only(['index']);
    Route::resource('badges', App\Http\Controllers\Admin\BadgeController::class)->names('badges');

    // Lainnya
    Route::resource('inbox', App\Http\Controllers\Admin\InboxController::class)->only(['index', 'show', 'destroy'])->names('inbox');
    Route::post('inbox/{message}/mark-read', [App\Http\Controllers\Admin\InboxController::class, 'markAsRead'])->name('inbox.mark-read');
});


Route::middleware('auth')->group(function () {
    // Old missions (will be deprecated)
    Route::resource('missions', MissionController::class);
    Route::get('missions/{mission}/articles', [MissionController::class, 'missionArticles']);
    Route::get('missions/{mission}/progress/{user}', [MissionController::class, 'userProgress']);
    Route::get('missions/{missionProgress}/article-progress/{missionArticle}', [MissionController::class, 'articleProgress']);

    // New Daily Missions
    Route::get('daily-missions', [App\Http\Controllers\DailyMissionController::class, 'index'])->name('daily-missions.index');
    Route::get('daily-missions/history', [App\Http\Controllers\DailyMissionController::class, 'history'])->name('daily-missions.history');
    Route::get('daily-missions/{date}', [App\Http\Controllers\DailyMissionController::class, 'show'])->name('daily-missions.show');
    Route::post('daily-missions/start-reading', [App\Http\Controllers\DailyMissionController::class, 'startReading'])->name('daily-missions.start-reading');
    Route::post('daily-missions/complete-reading', [App\Http\Controllers\DailyMissionController::class, 'completeReading'])->name('daily-missions.complete-reading');
    Route::post('daily-missions/complete-engage', [App\Http\Controllers\DailyMissionController::class, 'completeEngage'])->name('daily-missions.complete-engage');
    Route::post('daily-missions/start-quiz', [App\Http\Controllers\DailyMissionController::class, 'startQuiz'])->name('daily-missions.start-quiz');
    Route::post('daily-missions/submit-quiz', [App\Http\Controllers\DailyMissionController::class, 'submitQuiz'])->name('daily-missions.submit-quiz');
});


Route::get('admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'login']);
Route::post('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

require __DIR__.'/auth.php';