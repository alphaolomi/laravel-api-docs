<?php

// /api/login POST

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use function Pest\Laravel\postJson;

test('user can login ok', function () {
    $user = User::factory()->create();
    $data = ['email' => $user->email, 'password' => 'password'];

    postJson('/api/login', $data)
        ->assertJsonStructure(['access_token', 'user']);

});

// /api/register POST
test('user can register ok', function () {
    $user = User::factory()->make();
    $data = [
        'name' => $user->name,
        'email' => $user->email,
        'password' => 'password'
    ];

    postJson('/api/register', $data)
        ->assertJsonStructure(['access_token', 'user']);

});


// test missing user cant login
test('missing user cant login', function () {
    $data = ['email' => 'bad@server.com', 'password' => 'password'];

    postJson('/api/login', $data)
        ->assertStatus(Illuminate\Http\Response::HTTP_UNAUTHORIZED)
        ->assertJson(['code' => 'INVALID_CREDENTIALS']);
});

// test user can logout
test('user can logout', function () {
    $user = User::factory()->create();
    $data = ['email' => $user->email, 'password' => 'password'];

    Sanctum::actingAs($user);

    postJson('/api/login', $data)
        ->assertJsonStructure(['access_token', 'user']);


    postJson('/api/logout')
        ->assertNoContent();
});
