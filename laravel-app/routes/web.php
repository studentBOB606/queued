<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ListController;


Route::get('/', [WelcomeController::class, 'index']);
Route::get('/register', function () {
    return view('signup');
});
Route::post('/register', [AuthController::class, 'signup']);

Route::get('/films', [FilmController::class, 'index'])->name('films.index');
Route::get('/films/{film}', [FilmController::class, 'show'])->name('films.show');
Route::get('/search', [FilmController::class, 'search'])->name('films.search');

Route::get('/login', function () {
    return view('Login');
});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
Route::get('/list', [ListController::class, 'index']);
Route::post('/list', [ListController::class, 'store'])->name('list.store');
Route::delete('/list/{tmdb_id}', [ListController::class, 'destroy'])->name('list.destroy');
Route::get('/profile', function () {
    return auth()->check() ? view('profile') : redirect('/login');
});
