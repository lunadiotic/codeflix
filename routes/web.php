<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Categories
Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index']);
Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'store']);
Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'update']);
Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'delete']);
