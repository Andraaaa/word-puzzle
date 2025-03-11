<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Game;
use App\Models\Submission;

class LeaderboardControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user, 'sanctum');

        $this->game = Game::factory()->create();
    }

    /** @test */
    public function it_returns_the_top_10_leaderboard()
    {
        $submissions = [
            ['word' => 'apple', 'score' => 5],
            ['word' => 'banana', 'score' => 6],
            ['word' => 'cherry', 'score' => 6],
            ['word' => 'grape', 'score' => 5],
            ['word' => 'kiwi', 'score' => 4],
            ['word' => 'lemon', 'score' => 5],
            ['word' => 'mango', 'score' => 5],
            ['word' => 'orange', 'score' => 6],
            ['word' => 'peach', 'score' => 5],
            ['word' => 'pear', 'score' => 4],
            ['word' => 'plum', 'score' => 4],
            ['word' => 'strawberry', 'score' => 10],
        ];

        foreach ($submissions as $submission) {
            Submission::create([
                'game_id' => $this->game->id,
                'word' => $submission['word'],
                'score' => $submission['score'],
            ]);
        }

        $response = $this->getJson(route('leaderboard.index'));

        $response->assertStatus(200);

        $response->assertJsonCount(10);

        $response->assertJsonFragment(['word' => 'strawberry', 'score' => 10]);
        $response->assertJsonFragment(['word' => 'banana', 'score' => 6]);
        $response->assertJsonFragment(['word' => 'cherry', 'score' => 6]);
        $response->assertJsonFragment(['word' => 'orange', 'score' => 6]);

        $response->assertJsonMissing(['word' => 'plum']);
    }
}
