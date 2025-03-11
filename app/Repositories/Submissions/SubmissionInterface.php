<?php

namespace App\Repositories\Submissions;

use App\Models\Submission;
use Illuminate\Support\Collection;

interface SubmissionInterface
{
    function get(int $id): ?Submission;
    function store(array $data): ?Submission;

    function getByGameId(int $gameId);

    function getLeaderboard(): ?Collection;
}
