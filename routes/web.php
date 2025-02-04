<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTransactionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('/search', [FrontendController::class, 'search'])->name('frontend.search');
Route::get('/details/{product:slug}', [FrontendController::class, 'details'])->name('frontend.product.details');
Route::get('/category/{category}', [FrontendController::class, 'category'])->name('frontend.product.category');

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  Route::resource('carts', CartController::class)->middleware('role:buyer');
  Route::resource('product_transactions', ProductTransactionController::class)->middleware('role:owner|buyer');

  Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class)->middleware('role:owner');
    Route::resource('categories', CategoryController::class)->middleware('role:owner');
  });
});

require __DIR__ . '/auth.php';
