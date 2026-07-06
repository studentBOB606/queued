<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\WelcomeController;


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
Route::get('/list', function () {
    return view('List');
});
Route::get('/profile', function () {
    return auth()->check() ? view('profile') : redirect('/login');
});
