<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HealthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware([])->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::apiResource('products', App\Http\Controllers\ProductController::class)->only(['index', 'show']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', [ProfileController::class, '__invoke']);
        Route::get('/health-check', [HealthController::class, '__invoke']);
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::apiResource('products', ProductController::class)->only(['store', 'update', 'destroy']);
    });
});
