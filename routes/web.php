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

Route::middleware(['treblle'])->group(function () {
    Route::post('/avatar', function () {
        request()->file('avatar')->store('avatars');

        return 'ok';
    });
});


// 'auth',
Route::middleware([ 'treblle'])->get('/test', function () {
    $ed = easter_date();

    $data =  (date('Y-m-d', $ed) === date('Y-m-d')) ? 'Happy Easter' : '';

    return response()->json([
        'data' => $data,
    ]);
})->name('holiday.test');
