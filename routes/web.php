<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ADMIN
use App\Http\Controllers\Admin\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('.app');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

