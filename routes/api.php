<?php

use Illuminate\Support\Facades\Route;

Route::post('/login', (new App\Http\Controllers\AuthController())->login(...));
Route::post('/register', (new App\Http\Controllers\AuthController())->register(...));
Route::apiResource('products', App\Http\Controllers\ProductController::class);
Route::middleware('auth:sanctum')->group(function (): void {
    Route::get('/user', App\Http\Controllers\ProfileController::class);
    Route::get('/health-check', App\Http\Controllers\HealthController::class);
    Route::post('/logout', (new App\Http\Controllers\AuthController())->logout(...));

    // Route::apiResource('products', App\Http\Controllers\ProductController::class);

    Route::get('/collection', App\Http\Controllers\CollectionController::class);
});
