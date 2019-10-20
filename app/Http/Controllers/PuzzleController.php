<?php

namespace App\Http\Controllers;

use App\Puzzle;

use Auth;

use Inertia\Inertia;

class PuzzleController
{
    public function index()
    {
        return Inertia::render('Puzzles', [
            'page' => Puzzle::solved()->with(['users' => function ($query) {
                $query->where('id', Auth::user()->id);
            }])->latest()->select(['id'])->paginate(12),
        ]);
    }

    public function show(Puzzle $puzzle)
    {
        abort_unless($puzzle->solved, 404);

        return Inertia::render('Puzzle', [
            'puzzle' => $puzzle->load('words', 'letterCombination')->append('pangrams'),
        ]);
    }
}
