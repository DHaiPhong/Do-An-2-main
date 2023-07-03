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
            'order_number' => $this->faker->unique()->randomNumber(),
            'user_id'       =>      function () {
                return User::inRandomOrder()->first()->id;
            },
            'status' => $this->faker->randomElement(['pending', 'processing', 'completed', 'decline']),
            'grand_total' => $this->faker->randomFloat(6, 0, 10000000), // any number between 0 and 10000
            'item_count' => $this->faker->randomNumber(),
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'phone_number' => $this->faker->phoneNumber,
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
