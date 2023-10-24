<?php

use Illuminate\Support\Facades\Cache;

it('has user controller page', function () {
    // Arrange
    Cache::shouldReceive('get')
                    ->once()
                    ->with('key')
                    ->andReturn('value');

    // Act
    $response = $this->get('/test-cache');

    // Assert
    // also test that the response is a json response   
    $response->assertJson(['users' => 'value']);
});
