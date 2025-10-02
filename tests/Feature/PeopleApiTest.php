<?php

namespace Tests\Feature;

use App\Models\Like;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PeopleApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the recommendations endpoint.
     */
    public function test_recommendations_endpoint(): void
    {
        // Create test users
        User::factory()->count(5)->create();

        // Make request to recommendations endpoint
        $response = $this->get('/api/people/recommendations');

        // Assert response is successful and has the correct structure
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data',
            'links',
            'meta'
        ]);
    }

    /**
     * Test the liked endpoint.
     */
    public function test_liked_endpoint(): void
    {
        // Create test users
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        // Create a like
        Like::create([
            'person_id' => $user1->id,
            'user_id' => $user2->id,
            'is_like' => true
        ]);

        // Make request to liked endpoint
        $response = $this->get("/api/people/{$user2->id}/liked");

        // Assert response is successful and has the correct structure
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data',
            'links',
            'meta'
        ]);
    }

    /**
     * Test the like endpoint.
     */
    public function test_like_endpoint(): void
    {
        // Create test users
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        // Make request to like endpoint
        $response = $this->post("/api/people/{$user1->id}/like/{$user2->id}");

        // Assert response is successful
        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Person liked successfully',
            'success' => true
        ]);

        // Assert the like was created in the database
        $this->assertDatabaseHas('likes', [
            'person_id' => $user1->id,
            'user_id' => $user2->id,
            'is_like' => true
        ]);
    }

    /**
     * Test the dislike endpoint.
     */
    public function test_dislike_endpoint(): void
    {
        // Create test users
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        // Make request to dislike endpoint
        $response = $this->post("/api/people/{$user1->id}/dislike/{$user2->id}");

        // Assert response is successful
        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Person disliked successfully',
            'success' => true
        ]);

        // Assert the dislike was created in the database
        $this->assertDatabaseHas('likes', [
            'person_id' => $user1->id,
            'user_id' => $user2->id,
            'is_like' => false
        ]);
    }

    /**
     * Test that a user cannot like themselves.
     */
    public function test_cannot_like_self(): void
    {
        // Create test user
        $user = User::factory()->create();

        // Make request to like endpoint with same user ID
        $response = $this->post("/api/people/{$user->id}/like/{$user->id}");

        // Assert response is an error
        $response->assertStatus(400);
        $response->assertJson([
            'message' => 'Cannot like yourself',
            'success' => false
        ]);
    }

    /**
     * Test that a user cannot dislike themselves.
     */
    public function test_cannot_dislike_self(): void
    {
        // Create test user
        $user = User::factory()->create();

        // Make request to dislike endpoint with same user ID
        $response = $this->post("/api/people/{$user->id}/dislike/{$user->id}");

        // Assert response is an error
        $response->assertStatus(400);
        $response->assertJson([
            'message' => 'Cannot dislike yourself',
            'success' => false
        ]);
    }

    /**
     * Test updating an existing like.
     */
    public function test_update_existing_like(): void
    {
        // Create test users
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        // Create an initial dislike
        Like::create([
            'person_id' => $user1->id,
            'user_id' => $user2->id,
            'is_like' => false
        ]);

        // Make request to like endpoint to update the existing dislike
        $response = $this->post("/api/people/{$user1->id}/like/{$user2->id}");

        // Assert response is successful
        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Person liked successfully',
            'success' => true
        ]);

        // Assert the like was updated in the database
        $this->assertDatabaseHas('likes', [
            'person_id' => $user1->id,
            'user_id' => $user2->id,
            'is_like' => true
        ]);
    }
}