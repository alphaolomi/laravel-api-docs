<?php

// it return 401 when Unauthenticated

use function Pest\Laravel\getJson;

it('return 401 when Unauthenticated', function (): void {
    getJson('api/health-check')->assertUnauthorized();
});
