<?php

namespace App\Services\Word;

class LoadWordFileService
{
    public function load()
    {
        $filename = storage_path('words.txt');
        if (!file_exists($filename)) {
            die("Word list file not found!");
        }
        return file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }
}
