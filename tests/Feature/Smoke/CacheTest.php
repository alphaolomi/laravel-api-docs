<?php

use Illuminate\Support\Facades\Cache;

it('checks if item is cached', function() {
    Cache::shouldReceive('get')
        ->once()
        ->with('key')
        ->andReturn('value');

    $result = Cache::get('key');
    expect($result)->toBe('value');
});

it('sets cache correctly', function() {
    Cache::spy();

    // Some code that might set a cache...
    Cache::put('key', 'value', 60);

    Cache::shouldHaveReceived('put')->once()->with('key', 'value', 60);
});
