<?php

// /api/collection [GET] auth

use function Pest\Laravel\actingAs;

it('Collection Controller', function () {
    $user = App\Models\User::factory()->create();
    actingAs($user)->getJson('/api/collection')
        ->assertJsonStructure(['*' => ['name', 'price']]);
});
