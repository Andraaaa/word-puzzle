<?php
namespace App\Services\Word;

use App\Repositories\Games\GameInterface;

class RemainingWordsService
{
    public function get($gameId): string
    {
        $game = app(GameInterface::class)->get($gameId);
        $submissions = $game->submissions;

        $usedWords = !is_null($submissions) ? $submissions->pluck('word')->join('') : '';

        $availableLetters = str_split($game->letters);
        $usedLetters = str_split($usedWords);

        foreach ($usedLetters as $letter) {
            if (($key = array_search($letter, $availableLetters)) !== false) {
                unset($availableLetters[$key]);
                $availableLetters = array_values($availableLetters);
            }
        }

        return implode('', $availableLetters);
    }



}

