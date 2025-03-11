<?php

namespace App\Services\Game;

use App\Repositories\Games\GameInterface;
use App\Services\Puzzle\GeneratePuzzleService;

class StoreGameService
{
    public function store(): array
    {
        $letters = (new GeneratePuzzleService())->generate(20);

        $game = app(GameInterface::class)->store([
            'user_id' => auth()->id(),
            'letters' => $letters
        ]);

        return [
            'id' => $game->id,
            'letters' => $game->letters
        ];
    }
}
