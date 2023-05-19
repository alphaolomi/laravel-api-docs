<?php

use App\Models\User;
use function Pest\Laravel\travelTo;

test('inactive user scope', function (): void {
    // Create a user that was last active 2 days ago...
    $user = User::factory()->create([
        'email_verified_at' => now()->subDays(2),
        'updated_at' => now()->subDays(2),
    ]);

    // Travel into the future...
    travelTo(now()->addMinute());

    // Assert that the user is not in the scope...
    expect(User::inactive()->get())->toHaveCount(0);

    // Travel further into the future...
    travelTo(now()->addWeek());

    // Assert that the user is in the scope...
    expect(User::inactive()->get())->toHaveCount(1);
});
