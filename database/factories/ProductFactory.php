<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * @return array{name: string, description: string, price: float, is_active: bool, cover_image: string}
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'description' => fake()->paragraph(4),
            'price' => fake()->randomFloat(2, 10000, 300000),
            'is_active' => fake()->boolean(80),
            'cover_image' => fake()->imageUrl(640, 480, 'products', false, 'Shopify'),
        ];
    }
}
