<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // if has blue cookie
    // queuing cookie color to red

    if (request()->cookie('color') === 'blue') {
        cookie()->queue('color', 'red');
    }
    return view('welcome');
});

Route::post('/avatar', function () {
    request()->file('avatar')->store('avatars');
    return 'ok';
});

Route::middleware(['auth'])->get('/test', function () {
    $ed = easter_date();
    return (date('Y-m-d', $ed) === date('Y-m-d')) ? 'Happy Easter' : '';
})->name('holiday.test');
