<?php

use Illuminate\Support\Facades\Route;

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

// Listing Page - Homepage
Route::get('/', function () {
    return view('index');
})->name('home');

// Detail Page
Route::get('/detail', function () {
    return view('detail');
})->name('detail');

// Optional: Dynamic route for different articles
Route::get('/detail/{slug}', function ($slug) {
    return view('detail', ['slug' => $slug]);
})->name('detail.show');