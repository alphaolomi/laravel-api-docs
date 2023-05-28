<?php

it('should not use dd() or dump() anywhere', function () {
    expect(['dd', 'dump'])
        ->not
        ->toBeUsedIn('App');
})->group('arch');

it('should not use DB facade in controllers', function () {
    expect('Illuminate\Support\Facades\DB')
        ->not
        ->toBeUsedIn('App\Http\Controllers');
})->group('arch');
