<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use function Pest\Laravel\post;
use function Pest\Laravel\withCookie;

it('can upload files', function () {
    Storage::fake();

    [$width, $height] = [100, 100];

    $file = UploadedFile::fake()->image('avatar.jpg', $width, $height)->size(100);

    post('/avatar', ['avatar' => $file]);

    Storage::assertExists('avatars/'.$file->hashName());
});

it(' can interacting with cookies', function () {
    $color = 'blue';

    $response = withCookie('color', $color)->get('/');

    $response->assertCookie('color', 'red');
});
