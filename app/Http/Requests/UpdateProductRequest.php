<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
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

    public function bodyParameters()
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
