<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [MovieController::class, 'index']);

Route::get('/subscribe/plans', [SubscribeController::class, 'showPlans'])->name('subscribe.plans');
Route::get('/subscribe/plan/{plan}', [SubscribeController::class, 'checkoutPlan'])->name('subscribe.checkout');
Route::post('/subscribe/checkout', [SubscribeController::class, 'processCheckout'])->name('subscribe.process');
Route::get('/subscribe/success', [SubscribeController::class, 'showSuccess'])->name('subscribe.success');

Route::post('/checkout', [TransactionController::class, 'checkout'])->name('checkout');

Route::get('/home', [MovieController::class, 'index'])->name('home');
Route::get('/movies', [MovieController::class, 'all'])->name('movies.index');
Route::get('/movies/search', [MovieController::class, 'search'])->name('movies.search');
Route::get('/movies/{movie:slug}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::post('/logout', function (Request $request) {
    // Laravel Fortify menangani logout, kita hanya tambahkan middleware
    return app(\Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::class)->destroy($request);
})->middleware(['auth', 'logout.device'])->name('logout');


Route::get('/text-expired', function () {
    $membership = \App\Models\Membership::find(1);
    event(new \App\Events\MembershipHasExpired($membership));

    return 'Event fired';
});
