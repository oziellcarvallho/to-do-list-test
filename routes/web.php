<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [AuthController::class, 'loginGet'])->name('login.view');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(function() {
    Route::resource('user', UserController::class);
    Route::resource('task', TaskController::class);
})->middleware('auth');