<?php

namespace App\Services\Submission;

use App\Repositories\Submissions\SubmissionInterface;
use Illuminate\Support\Collection;

class GetLeaderboardService
{
    public function get():? Collection
    {
        return app(SubmissionInterface::class)->getLeaderboard();
    }
}
