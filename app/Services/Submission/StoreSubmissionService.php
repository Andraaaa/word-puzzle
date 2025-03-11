<?php

namespace App\Services\Submission;

use App\Repositories\Submissions\SubmissionInterface;
use App\Services\Word\RemainingWordsService;
use App\Services\Word\ValidateWords;
use App\Traits\ValidEnglishWordChecker;

class StoreSubmissionService
{
    use ValidEnglishWordChecker;

    public function store(array $data): array
    {
        $remainingLetters = (new RemainingWordsService())->get($data['gameId']);

        (new ValidateWords())->validate($data, $remainingLetters);

        $submission = app(SubmissionInterface::class)->store([
            'game_id' => $data['gameId'],
            'word' => $data['word'],
            'score' => strlen($data['word']),
        ]);

        return [
            'word' => $submission->word,
            'score' => $submission->score,
            'remaining_letters' => (new RemainingWordsService())->get($data['gameId']),
        ];
    }
}
