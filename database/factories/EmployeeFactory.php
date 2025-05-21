<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'passport_number' => fake()->regexify('[A-Z]{2}[0-9]{7}'),
            'last_name' => fake()->lastName(),
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->firstName(),
            'position' => fake()->jobTitle(),
            'phone' => fake()->regexify('/^\+998\d{9}$/'),
            'address' => fake()->address(),
            'enterprise_id' => 1,
        ];
    }
}
