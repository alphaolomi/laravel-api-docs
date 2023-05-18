<?php


use function Pest\Laravel\actingAs;


it('Health Controller', function () {
    $user = \App\Models\User::factory()->create();
   actingAs($user)->getJson('/api/health-check')
    ->assertJsonStructure(['status', 'services' => ['database', 'redis']]);
});
