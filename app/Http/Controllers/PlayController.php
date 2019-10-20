<?php

namespace App\Http\Controllers;

use App\Puzzle;

use Auth;

use Inertia\Inertia;

class PlayController
{
    public function __invoke()
    {
        return Inertia::render('Play', [
            'page' => Puzzle::solved()->with(['users' => function ($query) {
                $query->where('id', Auth::user()->id);
            }])->latest()->select(['id'])->paginate(12),
        ]);
    }
}
