<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => Product::all()->random()->prd_id,
            'rating' => $this->faker->numberBetween(3, 5),
            'user_id' => User::all()->random()->id,
        ];
    }
}
