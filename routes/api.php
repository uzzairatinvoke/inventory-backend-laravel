<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('login', [LoginController::class, 'login']);

    Route::post('logout', [LoginController::class, 'logout']);

    Route::group(['middleware' => 'auth:sanctum'], function () {

        Route::get('products', [ProductsController::class, 'index']);
        Route::get('products/{id}', [ProductsController::class, 'show']);
        Route::post('products', [ProductsController::class, 'store']);
        Route::patch('products/{id}', [ProductsController::class, 'update']);
        Route::delete('products/{id}', [ProductsController::class, 'destroy']);
    });
});
