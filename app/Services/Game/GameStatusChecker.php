<?php

namespace App\Services\Game;

use App\Repositories\Games\GameInterface;
use App\Services\Word\RemainingWordsService;
use App\Services\Word\ValidWordsFromLetters;

class GameStatusChecker
{
    public function checkIfGameShouldEnd($gameId): void
    {
        $remainingLetters = (new RemainingWordsService())->get($gameId);
        $validWords = (new ValidWordsFromLetters())->get($gameId);

        if (empty($remainingLetters) || count($validWords) === 0) {
            app(GameInterface::class)->update($gameId, [
                'active' => false
            ]);
        }
    }
}
