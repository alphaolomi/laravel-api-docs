<?php

use function Pest\Laravel\assertGuest;
use function Pest\Laravel\get;

test('the application returns a successful response', function () {
    get('/')->assertOk();
});

test('auth', function () {
    get(route('holiday.test'));
    assertGuest();
});
