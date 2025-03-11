<?php

namespace App\Services\Word;

class WordFilterService
{
    public function filter(array $words): array
    {
        return array_values(array_filter($words, function ($word) {
            return strlen($word) >= 3 && strlen($word) <= 7;
        }));
    }
}
