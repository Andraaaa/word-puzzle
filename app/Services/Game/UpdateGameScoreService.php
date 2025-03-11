<?php

namespace App\Services\Game;

use App\Repositories\Games\GameInterface;
use App\Repositories\Submissions\SubmissionInterface;

class UpdateGameScoreService
{
    public function update(int $gameId)
    {
        $totalScore = app(SubmissionInterface::class)->getByGameId($gameId)->pluck('score')->sum();

        return app(GameInterface::class)->update($gameId, ['score' => $totalScore]);
    }
}
