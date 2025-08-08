<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('uk_UA');

        return [
            'customer_name'  => $faker->name(),
            'customer_email' => $faker->safeEmail(),
            'total_amount'   => 0,
        ];
    }
}
