<?php
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoriesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')
->name('admin.')
->middleware('auth', 'role:admin|moderator')
->group(function () {

    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resources([
        'categories' => CategoriesController::class,
        'products' => ProductsController::class,
    ]);
    
});
