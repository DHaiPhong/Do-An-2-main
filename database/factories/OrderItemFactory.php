<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;


class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => function () {
                return Order::inRandomOrder()->create()->id;
            },
            'product_id' => function () {
                return Product::inRandomOrder()->create()->id;
            },
            'quantity' => $this->faker->randomDigit,
            'price' => $this->faker->randomFloat(6, 0, 10000000), // any price between $0 and $1000
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
