<?php

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;

it('can create a user', function () {
    $user = User::factory()->create();
    expect($user)->toExist();
});


it('can not create a user without email verification', function () {
    $user = User::factory()->unverified()->create();
    expect($user)->when(
        $user instanceof MustVerifyEmail,
        fn ($user) => $user->hasVerifiedEmail()->toBeFalse()
    );
});
