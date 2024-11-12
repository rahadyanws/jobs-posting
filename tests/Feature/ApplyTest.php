<?php

namespace Tests\Feature;

use App\Models\Candidate;
use App\Models\Vacancy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApplyTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_success()
    {
        // Create a vacancy and candidate
        $vacancy = Vacancy::factory()->create();
        $candidate = Candidate::factory()->create();

        $response = $this->postJson('/api/applies', [
            'vacancy_id' => $vacancy->vacancy_id,
            'candidate_id' => $candidate->candidate_id,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('applies', [
            'vacancy_id' => $vacancy->vacancy_id,
            'candidate_id' => $candidate->candidate_id,
        ]);
    }

    public function test_store_fails_with_invalid_vacancy_id()
    {
        $response = $this->postJson('/api/applies', [
            'vacancy_id' => "dummy", // Invalid vacancy ID
            'candidate_id' => "dummy",
        ]);

        $responseData = $response->json();

        $response->assertStatus(404);
        $this->assertEquals('Vacancy not found!', $responseData['message']);
    }
}
