<?php

namespace Database\Factories;

use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'user_id' => $this->generateUniqueUserId(),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'role' => fake()->numberBetween(1, 5),
            'password' => '$2a$12$GIlBJCcwXEp.hn0Y3CxuKuberB1jyWHSes2ZqeOV6DhZFMNG5jeBK', // 12345
            'remember_token' => Str::random(10),
        ];
    }

    private function generateUniqueUserId()
    {
        do {
            $user_id = random_int(10000000000, 99999999999); // 11 digit angka acak
        } while (\App\Models\User::where('user_id', $user_id)->exists());

        return $user_id;
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
