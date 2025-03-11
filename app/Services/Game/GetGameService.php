<?php

namespace App\Services\Game;

use App\Models\Game;
use App\Repositories\Games\GameInterface;

class GetGameService
{
    public function get(int $id): ?Game
    {
        return app(GameInterface::class)->get($id);
    }
}
