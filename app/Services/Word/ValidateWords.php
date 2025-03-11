<?php

namespace App\Services\Word;

use App\Models\Submission;
use App\Traits\ValidEnglishWordChecker;
use Illuminate\Validation\ValidationException;

class ValidateWords
{
    use ValidEnglishWordChecker;
    public function validate(array $data, string $remainingLetters) {
        if (Submission::wordAlreadyUsed($data['gameId'], $data['word'])) {
            throw ValidationException::withMessages([
                'word' => ['Word already used!']
            ]);
        }


        if (!$this->checkIsEnglishWord($data['word'])) {
            throw ValidationException::withMessages([
                'word' => ['Word is not an English word!']
            ]);
        }

        if (!(new WordListService())->canFormWord($data['word'], $remainingLetters)) {
            throw ValidationException::withMessages([
                'word' => ['Cannot use used letters!']
            ]);
        }
    }
}
