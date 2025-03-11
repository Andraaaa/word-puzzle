<?php

namespace App\Traits;
use Illuminate\Support\Facades\Http;

trait ValidEnglishWordChecker
{
    protected function checkIsEnglishWord(string $word): bool
    {
        $url = "https://api.dictionaryapi.dev/api/v2/entries/en/" . urlencode($word);

        $response = Http::get($url);

        return $response->successful();
    }
}
