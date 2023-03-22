<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/photos', function () {
    request()->file('photo')->store('photos');
});
