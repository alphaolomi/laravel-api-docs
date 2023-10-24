<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;


// write a test with AAA pattern and comments
it('logs the correct message when accessing route', function () {
    // Arrange
    // Clear the log
    File::put(storage_path('logs/laravel.log'), '');

    // Act
    $response = $this->get('/test-log');

    // Assert
    $response->assertJson(['message' => 'Logged successfully']);

    $logContents = File::get(storage_path('logs/laravel.log'));
    expect($logContents)->toContain('Message was logged');
});


// test using a shouldReceive
test('using mocks it logs the correct message when accessing route', function () {
    // no exceptions
    // $this->withoutExceptionHandling();
    // // Arrange
    // Log::shouldReceive('info')
    //     ->once()
    //     ->with('Your log message here')
    //     ->andReturnNull();

    // Act
    $response = $this->get('/test-log');

    // Assert
    $response->assertJson(['message' => 'Logged successfully']);


});
