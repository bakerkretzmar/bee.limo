<?php

namespace App\Http\Controllers;

use App\Puzzle;

use Inertia\Inertia;

class PlayController
{
    public function __invoke(Puzzle $puzzle)
    {
        abort_unless($puzzle->solved, 404);

        return Inertia::render('Play', [
            'puzzle' => $puzzle->load('words', 'letterCombination')->append('pangrams'),
        ]);
    }
}
