<?php

namespace App\Repositories\Games;

use App\Models\Game;
use Illuminate\Database\Eloquent\Builder;

class EloquentGames implements GameInterface
{

    function get(int $id): ?Game
    {
        return $this->newQuery()->find($id);
    }

    function store(array $data): ?Game
    {
        $query = $this->newQuery();

        $game = $query->create($data);

        return $game->fresh();
    }

    function update(int $id, array $data): ?Game
    {
        $game = $this->get($id);
        if (!$game) return null;
        $game->update($data);

        return $game->fresh();
    }

    protected function newQuery(): Builder
    {
        return (new Game())->newQuery();
    }
}
