<?php

namespace App\Http\Controllers;

use App\Puzzle;

use Inertia\Inertia;

class PlayController
{
    public function __invoke()
    {
        return Inertia::render('Play', [
            'data' => Puzzle::solved()->latest()->select(['id'])->paginate(12),
        ]);
    }
}
