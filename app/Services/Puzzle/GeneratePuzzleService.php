<?php

namespace App\Services\Puzzle;

use App\Services\Word\LoadWordFileService;
use App\Services\Word\WordFilterService;
use App\Services\Word\WordListService;

class GeneratePuzzleService
{
    public function generate(int $length): string
    {
        $words = (new LoadWordFileService())->load();
        $filteredWords = (new WordFilterService())->filter($words);

        return (new BuildPuzzleStringService())->build($filteredWords, $length);
    }
}
