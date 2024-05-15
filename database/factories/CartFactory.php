<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     *1
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::pluck('id')->toArray();
        $numberOfCarts = count($userIds);

        // Calculate the index of the current cart based on the number of created carts
        $currentCartIndex = $this->faker->unique()->numberBetween(0, $numberOfCarts - 1);

        // Get the user ID corresponding to the current cart index
        $userId = $userIds[$currentCartIndex];

        return [
            'user_id' => $userId,
        ];
    }
}
