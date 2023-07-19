<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(5, true);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->sentences(2, true),
            'image' => $this->faker->imageUrl,
            'price' => $this->faker->randomFloat(2, 0, 500),
            'sale_price' => $this->faker->randomFloat(2, 0, 500),
            'quantity' => $this->faker->randomNumber(3),
            'sku' => Str::slug($name),
        ];
    }
}
