<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apply>
 */
class ApplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'apply_id' => Str::uuid(),
            'vacancy_id' => $this->faker->uuid(),
            'candidate_id' => $this->faker->uuid(),
            'status' => $this->faker->randomElement(['new', 'process', 'accept', 'reject']),
        ];
    }
}
