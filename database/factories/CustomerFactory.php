<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_name' => $this->faker->name,
            'email' => $this->faker->email,
            'tel_num' => $this->faker->randomNumber(5),
            'address' => $this->faker->address(),
        ];
    }
}
