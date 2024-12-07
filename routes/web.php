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
