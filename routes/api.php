<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

// this is API versioning
Route::prefix('v1')->group(function () {

    // http://localhost:8000/api/v1/login
    Route::post('login', [LoginController::class, 'login']);

    Route::group(['middleware' => 'auth:sanctum'], function () {

        Route::post('logout', [LoginController::class, 'logout']);

        // Products routes
        Route::get('products', [ProductsController::class, 'index']);
        Route::get('products/{id}', [ProductsController::class, 'show']);
        Route::post('products', [ProductsController::class, 'create']);
        Route::patch('products/{id}', [ProductsController::class, 'update']);
        Route::delete('products/{id}', [ProductsController::class, 'destroy']);

        // Categories routes
        Route::get('categories', [CategoriesController::class, 'index']);
        Route::get('categories/{id}', [CategoriesController::class, 'show']);
        Route::post('categories', [CategoriesController::class, 'create']);
        Route::patch('categories/{id}', [CategoriesController::class, 'update']);
        Route::delete('categories/{id}', [CategoriesController::class, 'destroy']);
    });


});

// Route::prefix('v2')->group(function () {
//     Route::get('products', [ProductsController::class, 'indexNew']);
// }
