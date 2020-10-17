<?php

namespace App\Http\Controllers;

use App\Puzzle;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PuzzleController
{
    public function index(Request $request)
    {
        return Inertia::render('Puzzles', [
            'page' => Puzzle::solved()
                ->with(['users' => function ($query) use ($request) {
                    $query->where('id', $request->user()->id);
                }])
                ->latest()
                ->select(['id'])
                ->paginate(12),
        ]);
    }

    public function show(Request $request, Puzzle $puzzle)
    {
        abort_unless($puzzle->solved, 404);

        return Inertia::render('Puzzle', [
            'puzzle' => $puzzle->load('words', 'letterCombination')->append('pangrams'),
        ]);
    }

    public function random()
    {
        return redirect()->route('puzzles.show', Puzzle::solved()->inRandomOrder()->first());
    }
}
