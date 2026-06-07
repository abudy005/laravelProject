<?php

use App\Http\Controllers\AdminDashboard\AdminProductController;
use App\Http\Controllers\AdminDashboard\CategoryController;
use App\Http\Controllers\AdminDashboard\HomeController as AdminHomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/cart', fn () => redirect('/'))->name('cart.index');
Route::get('/category/{category:slug}', [HomeController::class, 'category'])->name('category');
Route::get('/product/{product}', [HomeController::class, 'product'])->name('product');

// Auth
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'loginForm')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});

// Admin — auth + role:admin protected
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('dashboard');
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
