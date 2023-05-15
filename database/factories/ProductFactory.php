<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(4),
            'price' => $this->faker->randomFloat(2, 10000, 300000),
            'is_active' => $this->faker->boolean(80),
            'cover_image' => $this->faker->imageUrl(640, 480, 'products', false, 'Shopify'),
        ];
    }
}
