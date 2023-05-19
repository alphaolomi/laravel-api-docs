<?php

it('should not use dd() or dump() anywhere', function (): void {
    expect(['dd', 'dump'])
        ->not
        ->toBeUsedIn('App');
})->group('arch');

it('should not use DB facade in controllers', function (): void {
    expect(\Illuminate\Support\Facades\DB::class)
        ->not
        ->toBeUsedIn('App\Http\Controllers');
})->group('arch');
