<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use Faker\Generator as Faker;
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
        return [
            'shipping_fee' => $this->faker->randomFloat(2, 5, 20),
            'status' => $this->faker->randomElement(['pending', 'shipped', 'delivered']),
            'date_placed' => $this->faker->date(),
            'date_shipped' => $this->faker->date(),
        ];
    }
}
