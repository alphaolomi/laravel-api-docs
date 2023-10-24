<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-log', [TestController::class, 'logMessage']);
Route::get('/test-cache', [UserController::class, 'index']);
