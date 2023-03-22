<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserModelsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $this->assertDatabaseCount('users', 5);
        $this->assertDatabaseHas('users', ['email' => 'sally@example.com']);
        $this->assertDatabaseMissing('users', ['email' => 'sally@example.com']);


        $this->expectsDatabaseQueryCount(5);

        // Test...

        $user = User::factory()->create();
        $this->assertModelExists($user);

        $user = User::factory()->create();
        $user->delete();

        $this->assertModelMissing($user);
    }
}
