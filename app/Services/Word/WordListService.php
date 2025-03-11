<?php

namespace App\Services\Word;

class WordListService
{
    public function canFormWord(string $word, string $letters): bool
    {
        $lettersCount = array_count_values(str_split($letters));

        foreach (str_split($word) as $letter) {
            if (empty($lettersCount[$letter])) {
                return false;
            }
            $lettersCount[$letter]--;
        }

        return true;
    }
}
