<?php

namespace App\Services\Game;

use App\Repositories\Games\GameInterface;
use App\Services\Word\ValidWordsFromLetters;

class EndGameService
{
    public function update(int $id): ?array
    {
        $game = app(GameInterface::class)->update($id, ['active' => false]);

        return [
            'gameId' => $game->id,
            'score' => $game->score,
            'validWords' => (new ValidWordsFromLetters())->get($id),
        ];

    }
}
