<?php

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

it('can create user', function () {
    $user = User::factory()->create();

    expect($user)->toBeInstanceOf(User::class);
    expect($user)->toBeInstanceOf(Authenticatable::class);

    test()->assertDatabaseCount('users', 1)
        ->expectsDatabaseQueryCount(1)
        ->assertModelExists($user);
});

// murators
it('can mutate name attribute', function () {
    $user = User::factory()->create(['name' => 'john doe']);

    expect($user->name)->toStartWith('J');
});

it('can not create a user without email verification', function () {
    $user = User::factory()->unverified()->create();
    // expect($user)->when(
    //     $user instanceof MustVerifyEmail,
    //     fn ($user) => $user->hasVerifiedEmail()->toBeFalse()
    // );

    expect($user->hasVerifiedEmail())->toBeFalse();

})->skip(fn () => (new User) instanceof MustVerifyEmail, 'MustVerifyEmail not supported');

// fillable

// scopes

// relations

// mutators

// casts

// accessors and mutators

// custom events
