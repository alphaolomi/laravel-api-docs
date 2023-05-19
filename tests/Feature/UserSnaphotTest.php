<?php

use App\Models\User;
use function Spatie\Snapshots\assertMatchesJsonSnapshot;
use function Spatie\Snapshots\assertMatchesSnapshot;

beforeEach(function (): void {
    $this->user = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'john@email.com',
    ]);
});

it('can be cast to string', function (): void {

    assertMatchesSnapshot('foo');
});

it('can be cast to json', function (): void {

    assertMatchesJsonSnapshot(json_encode(['foo' => 'bar']));
});
