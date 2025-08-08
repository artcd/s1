<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        $faker = \Faker\Factory::create('uk_UA');

        return [
            'name'           => $faker->name,
            'description'    => $faker->paragraph(),
            'price'          => $faker->randomFloat(2, 1, 100),
            'stock_quantity' => $faker->numberBetween(1, 100),
        ];
    }
}
