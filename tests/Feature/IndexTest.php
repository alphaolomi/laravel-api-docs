<?php

use function Pest\Laravel\assertGuest;
use function Pest\Laravel\get;

test('the application returns a successful response', function (): void {
    get('/')->assertOk();
});

test('auth', function (): void {
    get(route('holiday.test'));
    assertGuest();
});
