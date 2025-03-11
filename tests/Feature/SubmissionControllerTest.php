<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Game;
use App\Models\Submission;

class SubmissionControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user, 'sanctum');

        $this->game = Game::factory()->create(['letters' => 'applem']);
    }

    /** @test */
    public function it_stores_a_valid_submission()
    {
        $submissionData = [
            'gameId' => $this->game->id,
            'word' => 'apple'
        ];

        $response = $this->postJson(route('submission.store'), $submissionData);

        $response->assertStatus(200)
            ->assertJsonStructure(['word', 'score', 'remaining_letters']);

        $this->assertDatabaseHas('submissions', [
            'game_id' => $this->game->id,
            'word' => 'apple',
            'score' => 5
        ]);
    }

    /** @test */
    public function it_rejects_duplicate_words()
    {
        Submission::create([
            'game_id' => $this->game->id,
            'word' => 'apple',
            'score' => 5
        ]);

        $submissionData = [
            'gameId' => $this->game->id,
            'word' => 'apple'
        ];

        $response = $this->postJson(route('submission.store'), $submissionData);

        $response->assertJson([
            'message' => 'Word already used!',
            'errors' => [
                'word' => ['Word already used!']
            ]
        ]);

    }

    /** @test */
    public function it_rejects_non_english_words()
    {
        $submissionData = [
            'gameId' => $this->game->id,
            'word' => 'xyzabc'
        ];

        $response = $this->postJson(route('submission.store'), $submissionData);

        $response->assertJson([
            'message' => 'Word is not an English word!',
            'errors' => [
                'word' => ['Word is not an English word!']
            ]
        ]);

    }

    /** @test */
    public function it_rejects_words_using_invalid_letters()
    {
        // Prvo kreiramo submission koji troši neka slova
        Submission::create([
            'game_id' => $this->game->id,
            'word' => 'apple', // Iskoristili smo "a", "p", "p", "l", "e"
            'score' => strlen('apple')
        ]);

// Sada pokušavamo uneti "maple", ali "p" i "l" su već iskorišćeni
        $submissionData = [
            'gameId' => $this->game->id,
            'word' => 'maple'
        ];

        $response = $this->postJson(route('submission.store'), $submissionData);

        $response->assertStatus(422)
            ->assertJson([
                'message' => 'Cannot use used letters!',
                'errors' => [
                    'word' => ['Cannot use used letters!']
                ]
            ]);

    }
}
