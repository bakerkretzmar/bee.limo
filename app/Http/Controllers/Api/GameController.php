<?php

namespace App\Http\Controllers\Api;

use App\Puzzle;

use Auth;

class GameController
{
    public function __invoke(Puzzle $puzzle)
    {
        if (Auth::user()->puzzles()->where('puzzle_id', $puzzle->id)->doesntExist()) {
            Auth::user()->puzzles()->attach($puzzle);
        }

        return response()->json([
            'game' => Auth::user()->puzzles()->where('puzzle_id', $puzzle->id)->first()->pivot,
        ]);
    }
}
