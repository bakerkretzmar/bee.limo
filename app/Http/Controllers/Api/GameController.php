<?php

namespace App\Http\Controllers\Api;

use App\Puzzle;

use Auth;
use Illuminate\Http\Request;

class GameController
{
    public function show(Puzzle $puzzle)
    {
        if (Auth::user()->puzzles()->where('puzzle_id', $puzzle->id)->doesntExist()) {
            Auth::user()->puzzles()->attach($puzzle);
        }

        return response()->json([
            'game' => Auth::user()->puzzles()->where('puzzle_id', $puzzle->id)->first()->game,
        ]);
    }

    public function update(Request $request, Puzzle $puzzle)
    {
        Auth::user()->puzzles()->updateExistingPivot($puzzle->id, [
            'found_words' => $request->found_words,
        ]);

        return response()->json([]);
    }
}
