<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/register', function () {
    return view('signup');
});
Route::get('/films', function () {
    return view('Film');
});
Route::get('/login', function () {
    return view('Login');
});
Route::get('/list', function () {
    return view('List');
});
