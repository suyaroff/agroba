<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Enterprise>
 */
class EnterpriseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'director_name' => fake()->name(),
            'address' => fake()->address(),
            'email' => fake()->safeEmail(),
            'website' => fake()->domainName(),
            'phone' => fake()->regexify('/^\+998\d{9}$/'),
            'owner_id' => 1,
        ];
    }
}
