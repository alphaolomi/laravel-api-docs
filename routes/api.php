<?php

use Illuminate\Support\Facades\Route;

Route::middleware([])->group(function () {
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);


    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', [App\Http\Controllers\ProfileController::class, '__invoke']);
        Route::get('/health-check', [App\Http\Controllers\HealthController::class, '__invoke']);
        Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);

        Route::apiResource('products', App\Http\Controllers\ProductController::class);
    });
});
