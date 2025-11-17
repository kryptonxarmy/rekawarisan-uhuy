<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JejakMaestroController;
use App\Http\Controllers\MissionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('frontend.beranda');
})->name('beranda');

Route::get('/faq', function () {
    return view('frontend.page.faq');
})->name('faq');

Route::get('/kebijakan-privasi', function () {
    return view('frontend.page.kebijakan');
})->name('kebijakan-privasi');

Route::get('/contact', function () {
    return view('frontend.page.contact');
})->name('contact');


/*
|--------------------------------------------------------------------------
| Jejak Maestro + Daily Mission (HARUS LOGIN)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Halaman Jejak Maestro
    Route::get('/jejak-maestro', [JejakMaestroController::class, 'index'])
        ->name('jejakmaestro');

    // Daily Mission actions
    Route::post('/mission/complete/read', [MissionController::class, 'completeRead'])
        ->name('mission.complete.read');

    Route::post('/mission/complete/share', [MissionController::class, 'completeShare'])
        ->name('mission.complete.share');

    Route::post('/mission/complete/quiz', [MissionController::class, 'completeQuiz'])
        ->name('mission.complete.quiz');
});


/*
|--------------------------------------------------------------------------
| Error pages
|--------------------------------------------------------------------------
*/

Route::get('/200', fn () => view('frontend.errors.200'))->name('200');
Route::get('/400', fn () => view('frontend.errors.400'))->name('400');
Route::get('/404', fn () => view('frontend.errors.404'))->name('404');
Route::get('/500', fn () => view('frontend.errors.500'))->name('500');


/*
|--------------------------------------------------------------------------
| Dashboard & Profile
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
