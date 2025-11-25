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
    
    // --- DASHBOARD ---
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

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

// Untuk user submit artikel
Route::post('/articles/store-user', [ArticleController::class, 'store'])
     ->name('user.articles.store')
     ->middleware('auth');


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

