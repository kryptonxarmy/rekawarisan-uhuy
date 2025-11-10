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

Route::get('/', function () {
    return view('frontend.beranda');
})->name('beranda');

// rooute page
route::get('/faq', function () {
    return view('frontend.page.faq');
})->name('faq');

route::get('/kebijakan-privasi', function () {
    return view('frontend.page.kebijakan');
})->name('kebijakan-privasi');

route::get('/contact', function () {
    return view('frontend.page.contact');
})->name('contact');

// end route page

// route jejak maestro
route::get('/jejak-maestro', function () {
    return view('frontend.jejakmaestro.index');
})->name('jejakmaestro');

// end route jejak maestro
Route::get('/200', function () {
    return view('frontend.errors.200');
})->name('200');

Route::get('/400', function () {
    return view('frontend.errors.400');
})->name('400');

Route::get('/404', function () {
    return view('frontend.errors.404');
})->name('404');

Route::get('/500', function () {
    return view('frontend.errors.500');
})->name('500');