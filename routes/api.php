<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [App\Http\Controllers\ProfileController::class, '__invoke']);
    Route::get('/health-check', [App\Http\Controllers\HealthController::class, '__invoke']);
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);

    Route::apiResource('posts', App\Http\Controllers\PostController::class);

    Route::get('/collection', [App\Http\Controllers\CollectionController::class, '__invoke']);
});
