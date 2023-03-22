<?php

use Mockery;

class PaymentClient
{
    public function request()
    {
        // Do something...
    }
}

class BookRepository
{
    private $client;

    public function __construct(PaymentClient $client)
    {
        $this->client = $client;
    }

    public function buy()
    {
        $this->client->request();
    }
}

it('should buy a book', function () {
    $client = Mockery::mock(PaymentClient::class);
    $client->shouldReceive('post');

    $books = new BookRepository($client);
    $books->buy(); // The API is not actually invoked since `$client->post()` has been mocked...


});
