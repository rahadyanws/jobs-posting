<?php

namespace Tests\Feature;

use App\Models\Candidate;
use App\Models\Vacancy;
use App\Models\Apply;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

    public function testUpdateApply()
    {
        // Create a sample Apply record
        $apply = Apply::factory()->create();

        // Prepare the update request data
        $updateData = [
            'vacancy_id' => 'new_vacancy_id',
            'candidate_id' => 'new_candidate_id',
            'status' => 'accept',
        ];

        // Send the PUT request to the update endpoint
        $response = $this->putJson("/api/applies/{$apply->apply_id}", $updateData);

        // Assert the response
        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Apply success updated!',
            ]);

        // Assert the updated Apply record
        $updatedApply = Apply::find($apply->apply_id);
        $this->assertEquals($updateData['vacancy_id'], $updatedApply->vacancy_id);
        $this->assertEquals($updateData['candidate_id'], $updatedApply->candidate_id);
        $this->assertEquals($updateData['status'], $updatedApply->status);
    }

    /**
     * Test the showAllCandidateByVacancyId method.
     *
     * @return void
     */
    public function test_show_all_candidates_by_vacancy_id()
    {
        $vacancy = Vacancy::factory()->create();
        $candidates = Apply::factory()->count(3)->create(['vacancy_id' => $vacancy->vacancy_id]);

        $response = $this->getJson("/api/applies/{$vacancy->vacancy_id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    '*' => [
                        'id',
                        'vacancy_id',
                        // ... other fields of Apply model
                    ]
                ]
            ]);
    }

    /**
     * Test the showAllCandidateByVacancyId method with invalid vacancy ID.
     *
     * @return void
     */
    public function test_show_all_candidates_by_invalid_vacancy_id()
    {
        $invalidId = 0;

        $response = $this->getJson("/api/applies/{$invalidId}");

        $response->assertStatus(404)
            ->assertJsonStructure([
                'success',
                'message',
                'data'
            ]);
    }
}
