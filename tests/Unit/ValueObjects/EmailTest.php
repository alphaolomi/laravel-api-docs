<?php

use App\ValueObjects\Email;


it('can be created from valid email', function (string $string): void {

    $email = Email::fromString($string);

    $this->assertSame($string, $email->asString());
})->with([
    'johndoe@gmail.com',
    'john+doe@gmail.com',
]);

it('cannot be created from invalid email', function (string $string): void {
    Email::fromString($string);
})->with([
    'invalid_john',
    'johndoe@',
    'johndoe@gmail',
    'johndoe@gmail.',
])->throws(InvalidArgumentException::class);
