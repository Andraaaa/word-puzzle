<?php
//
//namespace App\Services\Word;
//
//use App\Repositories\Games\GameInterface;
//use App\Repositories\Submissions\SubmissionInterface;
//
//class RemainingWordsService
//{
//    public function getRemainingLetters($gameId)
//    {
//        $game = app(GameInterface::class)->get($gameId);
//        $submission = app(SubmissionInterface::class)->getByGameId($gameId);
//        $usedWords = !is_null($submission) ? $submission->pluck('word') : '';
//
//        $availableLetters = str_split($game->letters);
//        $usedLetters = str_split($usedWords);
//
//        foreach ($usedLetters as $letter) {
//            if (($key = array_search($letter, $availableLetters)) !== false) {
//                unset($availableLetters[$key]);
//                $availableLetters = array_values($availableLetters);
//            }
//        }
//
//        return implode('', $availableLetters);
//    }
//
//    public function getValidWordsFromLetters($letters)
//    {
//        $words = file(storage_path('words.txt'), FILE_IGNORE_NEW_LINES);
//        $valid_words = [];
//
//        foreach ($words as $word) {
//            if ((new WordListService())->canFormWord($word, $letters)) {
//                $valid_words[] = $word;
//            }
//        }
//
//        return $valid_words;
//    }
//}


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

