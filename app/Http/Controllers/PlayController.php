<?php

namespace App\Http\Controllers;

use App\Puzzle;

use Inertia\Inertia;

class PlayController
{
    public function __invoke(Puzzle $puzzle)
    {
        abort_unless($puzzle->is_analyzed, 404);

        return Inertia::render('Play', [
            'puzzle' => $puzzle->load('words', 'letterCombination')->append('pangrams'),
            // 'event' => $event->only('id', 'title', 'start_date', 'description'),
        ]);
    }
}
