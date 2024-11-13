<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_successful_logout()
    {
        // Create a User and token
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        // Act
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
        ->postJson('/api/logout');

        // Assert
        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Logout success!',
                     'data' => [],
                 ]);

    }
}
