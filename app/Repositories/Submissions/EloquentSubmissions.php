<?php

namespace App\Repositories\Submissions;

use App\Models\Submission;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class EloquentSubmissions implements SubmissionInterface
{
    function get(int $id): ?Submission
    {
        return $this->newQuery()->find($id);
    }

    function store(array $data): ?Submission
    {
        $query = $this->newQuery();

        $submission = $query->create($data);

        return $submission->fresh();
    }

    function getByGameId(int $gameId)
    {
        return $this->newQuery()->where('game_id', $gameId);
    }

    function getLeaderboard(): ?Collection
    {
        return $this->newQuery()
            ->select('word', DB::raw('MAX(score) as score'))
            ->groupBy('word')
            ->orderByDesc('score')
            ->orderBy('word')
            ->limit(10)
            ->get();
    }

    protected function newQuery(): Builder
    {
        return (new Submission())->newQuery();
    }
}
