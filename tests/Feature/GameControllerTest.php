<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Game;

class GameControllerTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function it_creates_a_new_game_successfully()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson('/api/game');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'letters' => [
                    'id',
                    'letters',
                ]
            ]);

        $this->assertDatabaseHas('games', [
            'user_id' => $user->id
        ]);
    }

    /** @test */
    public function it_shows_an_existing_game()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $game = Game::factory()->create([
            'user_id' => $user->id,
            'letters' => 'applebanana'
        ]);

        $response = $this->getJson("/api/game/{$game->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $game->id,
                'letters' => $game->letters
            ]);
    }

    /** @test */
    public function it_should_end_an_existing_game()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $game = Game::factory()->create([
            'user_id' => $user->id,
            'letters' => 'applebanana'
        ]);

        $updatePayload = [
            'id' => $game->id
        ];

        $response = $this->putJson("/api/game/{$game->id}", $updatePayload);

        $response->assertStatus(200);

        $this->assertDatabaseHas('games', [
            'id' => $game->id,
            'active' => false
        ]);
    }


}
