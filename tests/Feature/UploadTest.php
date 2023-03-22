<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_albums_can_be_uploaded()
    {
        Storage::fake('photos');

        $response = $this->json('POST', '/photos', [
            UploadedFile::fake()->image('photo1.jpg'),
            UploadedFile::fake()->image('photo2.jpg')
        ]);

        $storage = Storage::disk('photos');
        // Assert one or more files were stored...
        $storage->assertExists('photo1.jpg');
        $storage->assertExists(['photo1.jpg', 'photo2.jpg']);

        // Assert one or more files were not stored...
        $storage->assertMissing('missing.jpg');
        $storage->assertMissing(['missing.jpg', 'non-existing.jpg']);

        // Assert that a given directory is empty...
        $storage->assertDirectoryEmpty('/wallpapers');
    }

    public function test_interacting_with_cookies()
    {
        $response = $this->withCookie('color', 'blue')->get('/');

        $response = $this->withCookies([
            'color' => 'blue',
            'name' => 'Taylor',
        ])->get('/');
    }
}
