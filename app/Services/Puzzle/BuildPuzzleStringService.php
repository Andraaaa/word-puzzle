<?php

namespace App\Services\Puzzle;

class BuildPuzzleStringService
{
    public function build(array $words, int $length): string
    {
        shuffle($words);
        usort($words, fn($a, $b) => strlen($a) <=> strlen($b));

        $result = array_reduce($words, function ($carry, $word) use ($length) {
            $totalLength = array_sum(array_map('strlen', $carry));
            return ($totalLength + strlen($word) <= $length) ? array_merge($carry, [$word]) : $carry;
        }, []);

        $baseString = implode('', $result);
        $extraLength = $length - strlen($baseString);
        $baseString .= substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, $extraLength);

        return str_shuffle($baseString);
    }
}
