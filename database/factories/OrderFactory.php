<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_number' => 'ORD-' . substr(md5(uniqid(rand(), true)), 0, 12),
            'user_id' => 22,
            'status' => 'completed',
            'updated_by' => 22,
            'grand_total' => $this->faker->randomFloat(6, 5000000, 10000000),
            'item_count' => $this->faker->numberBetween(0, 5),
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'phone_number' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'created_at' => $this->faker->dateTimeBetween('2023-01-01', '2023-07-25'),
            'updated_at' => $this->faker->dateTimeBetween('2023-01-01', '2023-07-25'),
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
