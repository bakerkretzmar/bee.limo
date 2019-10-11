<?php

namespace App\Http\Controllers;

// use App\Puzzle;

use Inertia\Inertia;

class PlayController
{
    public function __invoke()
    {
        return Inertia::render('Play', [
            // 'puzzle' => $puzzle->load('words', 'letterCombination')->append('pangrams'),
        ]);
    }
}
