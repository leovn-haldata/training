<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_name' => 'Product ' . $this->faker->numerify,
            'product_image' => $this->faker->imageUrl,
            'product_price' => $this->faker->numerify,
            'description' => $this->faker->paragraph,

        ];
    }
}
