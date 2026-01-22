<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

// Products routes
Route::group(['middleware' => 'auth:sanctum'], function () {
Route::get('productsget', [ProductsController::class, 'index'])->name('product.index');
Route::get('products/{id}', [ProductsController::class, 'show']);
Route::post('products', [ProductsController::class, 'create'])->name('product.create');
Route::patch('products/{id}', [ProductsController::class, 'update']);
Route::delete('products/{id}', [ProductsController::class, 'destroy']);
});