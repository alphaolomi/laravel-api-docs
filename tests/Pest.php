<?php

use Illuminate\Support\Facades\File;

uses(
    Tests\TestCase::class,
    Illuminate\Foundation\Testing\LazilyRefreshDatabase::class,
)->in('Feature');


expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

function asUser(array $data = []): Tests\TestCase
{
    $user = App\Models\User::factory()->create($data);

    return test()->actingAs($user);
}

function asApiUser(array $data = [], array $abilities = []): Tests\TestCase
{
    $user = App\Models\User::factory()->create($data);

    Laravel\Sanctum\Sanctum::actingAs($user, $abilities);

    return test();
}

// request_classes
function requestClasses(): array
{
    $files = File::glob(app_path('Http/Requests/*.php'));

    return collect($files)->map(function ($file) {
        $className = 'App\\Http\\Requests\\' . str_replace('.php', '', basename($file));

        return [$className];
    })->toArray();
}
