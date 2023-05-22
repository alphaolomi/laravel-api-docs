<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * @return array{name: string, email: string, password: string}
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|unique:users,email|max:255',
            'password' => 'required|string|min:6|max:128',
        ];
    }

    /**
     * @return array{name: array{description: string, example: string}, email: array{description: string, example: string}, password: array{description: string, example: string}}
     */
    public function bodyParameters(): array
    {
        return [
            'name' => [
                'description' => 'The name of the user.',
                'example' => 'John Doe',
            ],
            'email' => [
                'description' => 'The email of the user.',
                'example' => '',
            ],
            'password' => [
                'description' => 'The password of the user.',
                'example' => '',
            ],
        ];

    }
}
