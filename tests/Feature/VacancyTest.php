<?php

namespace Tests\Feature;

use App\Models\Vacancy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VacancyTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_vacancy_list()
    {
        // Create some vacancies
        Vacancy::factory()->count(5)->create();

        $response = $this->getJson('/api/vacancies');

        $responseData = $response->json();

        $response->assertStatus(200);
        $this->assertEquals('Vacancies data list.', $responseData['message']);
    }

    /**
     * Test the store method.
     *
     * @return void
     */
    public function test_store_vacancy()
    {
        $data = [
            'title' => 'Test Vacancy',
            'description' => 'Test Description',
            'requirement' => 'Test Requirement',
            'status' => 'publish',
            'company_name' => 'Test Company',
        ];

        $response = $this->postJson('/api/vacancies', $data);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'vacancy_id',
                    'title',
                    'description',
                    'requirement',
                    'status',
                    'company_name',
                ],
            ]);

        $this->assertDatabaseHas('vacancies', $data);
    }

    /**
     * Test the show method.
     *
     * @return void
     */
    public function test_show_vacancy()
    {
        $vacancy = Vacancy::factory()->create();

        $response = $this->getJson("/api/vacancies/{$vacancy->vacancy_id}");

        $responseData = $response->json();

        $response->assertStatus(200);
        $this->assertEquals('Detail Data Vacancy!', $responseData['message']);
    }

    /**
     * Test the update method.
     *
     * @return void
     */
    public function test_update_vacancy()
    {
        $vacancy = Vacancy::factory()->create();

        $updateData = [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'requirement' => 'Updated Requirement',
            'status' => 'draft',
            'company_name' => 'Updated Company',
        ];

        $response = $this->putJson("/api/vacancies/{$vacancy->vacancy_id}", $updateData);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'data'
            ]);

        $this->assertDatabaseHas('vacancies', $updateData);
    }

    /**
     * Test the update method with invalid vacancy ID.
     *
     * @return void
     */
    public function test_update_vacancy_with_invalid_id()
    {
        $invalidId = 'invalid_id';
        $updateData = [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'requirement' => 'Updated Requirement',
            'status' => 'draft',
            'company_name' => 'Updated Company',
        ];

        $response = $this->putJson("/api/vacancies/{$invalidId}", $updateData);

        $response->assertStatus(404)
            ->assertJsonStructure([
                'success',
                'message'
            ]);
    }

    /**
     * Test the update method with invalid validation data.
     *
     * @return void
     */
    public function test_update_vacancy_with_invalid_data()
    {
        $vacancy = Vacancy::factory()->create();

        $invalidData = [
            'title' => '', // Empty title
            'description' => 'Updated Description',
            'requirement' => 'Updated Requirement',
            'status' => 'publish',
            'company_name' => 'Updated Company',
        ];

        $response = $this->putJson("/api/vacancies/{$vacancy->vacancy_id}", $invalidData);

        $response->assertStatus(422);
    }
}