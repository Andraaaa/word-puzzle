<?php

namespace App\Observers;

use App\Models\Submission;
use App\Services\Game\GameStatusChecker;
use App\Services\Game\UpdateGameScoreService;

class SubmissionObserver
{
    /**
     * Handle the Submission "created" event.
     */
    public function created(Submission $submission): void
    {
        (new UpdateGameScoreService())->update($submission->game->id);
        (new GameStatusChecker())->checkIfGameShouldEnd($submission->game->id);
    }
}
