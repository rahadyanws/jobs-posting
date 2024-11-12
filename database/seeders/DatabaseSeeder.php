<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Candidate::create([
            'candidate_id' => Str::uuid(),
            'name' => 'John Smith',
            'email' => 'john@email.com',
            'phone' => '08000',
            'experience' => 'Candidate experience',
            'education' => 'Candidate education'
        ]);
    }
}
