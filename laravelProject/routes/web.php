<?php

use App\Http\Controllers\AdminDashboard\AdminProductController;
use App\Http\Controllers\AdminDashboard\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Placeholder — wired properly in Step 05
Route::get('/login', fn () => redirect('/'))->name('login');
Route::get('/cart', fn () => redirect('/'))->name('cart.index');
Route::get('/category/{slug}', fn ($slug) => redirect('/'))->name('category');

// Admin — protected properly in Step 05
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => view('admin.dashboard'))->name('dashboard');
    Route::get('main-categories/create', [CategoryController::class, 'createMain'])->name('main-categories.create');
    Route::post('main-categories', [CategoryController::class, 'storeMain'])->name('main-categories.store');
    Route::resource('categories', CategoryController::class);

    Route::prefix('product')->name('product.')->controller(AdminProductController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/show/{product}', 'show')->name('show');
        Route::get('/edit/{product}', 'edit')->name('edit');
        Route::put('/update/{product}', 'update')->name('update');
        Route::delete('/delete/{product}', 'destroy')->name('destroy');
    });
});
