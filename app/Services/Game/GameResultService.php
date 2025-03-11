<?php

namespace App\Services\Game;

use App\Repositories\Games\GameInterface;
use App\Services\Word\ValidWordsFromLetters;

class GameResultService
{
    public function get(int $id): array
    {
        $game = app(GameInterface::class)->get($id);
        $remainingWords = (new ValidWordsFromLetters())->get($game->id);

        return [
            'gameId' => $game->id,
            'status' => $game->active ? 'active' : 'inactive',
            'totalScore' => $game->score,
            'validWordsRemaining' => count($remainingWords) > 0 ? $remainingWords : 'No remaining words',

        ];
    }
}
