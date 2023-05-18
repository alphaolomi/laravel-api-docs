<?php

use function Pest\Laravel\actingAs;


it('Profile Contrller', function () {
    $user = App\Models\User::factory()->create();
    actingAs($user)->get('/api/user')->assertJsonStructure(['id', 'name', 'email']);
});
