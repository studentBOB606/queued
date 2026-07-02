<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/register', function () {
    return view('signup');
});
Route::post('/register', [AuthController::class, 'signup']);
Route::get('/films', function () {
    return view('Film');
});
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
