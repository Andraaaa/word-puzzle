<?php

namespace App\Services\Word;

use App\Repositories\Submissions\SubmissionInterface;

class ValidWordsFromLetters
{
    public function get($gameId)
    {
        $allWords = (new LoadWordFileService())->load();
        $submission = app(SubmissionInterface::class)->getByGameId($gameId);
        $usedWords = !is_null($submission) ? $submission->pluck('word')->toArray() : [];
        $remainingLetters = (new RemainingWordsService())->get($gameId);
        $validWords = [];

        foreach ($allWords as $word) {
            if (!in_array($word, $usedWords) && (new WordListService())->canFormWord($word, $remainingLetters)) {
                $validWords[] = $word;
            }
        }

        return $validWords;
    }
}
