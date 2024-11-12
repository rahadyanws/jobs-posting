<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vacancy>
 */
class VacancyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vacancy_id' => fake()->uuid(),
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraph(),
            'requirement' => fake()->paragraph(),
            'status' => fake()->randomElement(['publish', 'draft']),
            'company_name' => fake()->company(),
        ];
    }
}
