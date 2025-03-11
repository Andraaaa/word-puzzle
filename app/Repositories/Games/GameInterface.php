<?php

namespace App\Repositories\Games;

use App\Models\Game;

interface GameInterface
{
    function get(int $id): ?Game;
    function store(array $data): ?Game;

    function update(int $id, array $data): ?Game;
}
