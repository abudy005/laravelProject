<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Placeholder — wired properly in Step 05
Route::get('/login', fn () => redirect('/'))->name('login');
Route::get('/cart', fn () => redirect('/'))->name('cart.index');
Route::get('/category/{slug}', fn ($slug) => redirect('/'))->name('category');

// Admin placeholder — protected properly in Step 05
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => view('admin.dashboard'))->name('dashboard');
});
