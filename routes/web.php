<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Categories
Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index']);
Route::get('/categories/create', [App\Http\Controllers\CategoryController::class, 'store']);
Route::get('/categories/update', [App\Http\Controllers\CategoryController::class, 'update']);
Route::get('/categories/delete', [App\Http\Controllers\CategoryController::class, 'delete']);

// Rating
Route::get('/ratings', [App\Http\Controllers\RatingController::class, 'index']);
Route::get('/ratings/create', [App\Http\Controllers\RatingController::class, 'store']);

// Movies
Route::get('/movies', [App\Http\Controllers\MovieController::class, 'index']);
Route::get('/movies/attach', [App\Http\Controllers\MovieController::class, 'attach']);
Route::get('/movies/detach', [App\Http\Controllers\MovieController::class, 'detach']);
Route::get('/movies/sync', [App\Http\Controllers\MovieController::class, 'sync']);


use App\Http\Controllers\AuthController;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
