<?php

use App\Http\Controllers\AdminDashboard\AdminProductController;
use App\Http\Controllers\AdminDashboard\CategoryController;
use App\Http\Controllers\AdminDashboard\HomeController as AdminHomeController;
use App\Http\Controllers\AdminDashboard\OrderController as AdminOrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{category:slug}', [HomeController::class, 'category'])->name('category');
Route::get('/product/{product}', [HomeController::class, 'product'])->name('product');

// Auth
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'loginForm')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});

// Cart + Orders (require auth)
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cart}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('place.order');
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

    Route::prefix('orders')->name('orders.')->controller(AdminOrderController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{order}', 'show')->name('show');
        Route::post('/status/{order}', 'updateStatus')->name('updateStatus');
    });
});
