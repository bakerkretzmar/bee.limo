<?php

namespace App\Http\Controllers\Api;

use App\LetterCombination;
use App\Word;

class StatsController
{
    public function __invoke()
    {
        return response()->json([
            'words' => cache()->remember('stats:words', now()->addMinute(), function () {
                return Word::count();
            }),
            'letter_combinations' => cache()->remember('stats:letter_combinations', now()->addMinute(), function () {
                return LetterCombination::count();
            }),
        ]);
    }
}
