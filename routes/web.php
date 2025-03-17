<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Ajax\AddToCartController;
use App\Http\Controllers\Ajax\RemoveImageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', \App\Http\Controllers\HomeController::class)->name('home');

Auth::routes();

Route::resource('products', \App\Http\Controllers\ProductsController::class)
    ->only(['index', 'show']);
Route::resource('categories', \App\Http\Controllers\CategoriesController::class)
    ->only(['index', 'show']);

Route::get('checkout', CheckoutController::class)->name('checkout');
Route::name('cart.')->prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::delete('/', [CartController::class, 'remove'])->name('remove');
    Route::post('{product}', [CartController::class, 'add'])->name('add');
    Route::put('{product}', [CartController::class, 'update'])->name('update');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin|moderator'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('categories', \App\Http\Controllers\Admin\CategoriesController::class)
        ->except(['show']);
    Route::resource('products', \App\Http\Controllers\Admin\ProductsController::class)
        ->except(['show']);
});

Route::prefix('ajax')->name('ajax.')->group(function () {
    Route::post('cart/{product}', AddToCartController::class)->name('cart.add');

    Route::middleware(['auth', 'role:admin|moderator'])->group(function () {
        Route::delete('images/{image}', RemoveImageController::class)->name('images.remove');
    });
});