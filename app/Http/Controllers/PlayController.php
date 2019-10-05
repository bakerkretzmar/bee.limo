<?php

namespace App\Http\Controllers;

use App\Puzzle;

use Inertia\Inertia;

class PlayController
{
    public function __invoke()
    {
        return Inertia::render('Play', [
            'puzzle' => Puzzle::with('words', 'letterCombination')->analyzed()->skip(1)->first(),
            // 'event' => $event->only('id', 'title', 'start_date', 'description'),
        ]);
    }
}
