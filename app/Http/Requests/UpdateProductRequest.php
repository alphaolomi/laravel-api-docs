<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * @return array{name: string, description: string, price: string, is_active: string, cover_image: string}
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|money',
            'is_active' => 'nullable|boolean',
            'cover_image' => 'nullable|string',
        ];
    }

    /**
     * @return array{name: array{description: string, example: string}, description: array{description: string, example: string}, price: array{description: string, example: int}, is_active: array{description: string, example: true}, cover_image: array{description: string, example: string}}
     */
    public function bodyParameters(): array
    {
        return [
            'name' => [
                'description' => 'The name of the product.',
                'example' => 'Product name',
            ],
            'description' => [
                'description' => 'The description of the product.',
                'example' => 'Product description',
            ],
            'price' => [
                'description' => 'The price of the product.',
                'example' => 100,
            ],
            'is_active' => [
                'description' => 'The status of the product.',
                'example' => true,
            ],
            'cover_image' => [
                'description' => 'The cover image of the product.',
                'example' => 'https://example.com/image.jpg',
            ],
        ];
    }
}
