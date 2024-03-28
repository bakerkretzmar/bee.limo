<?php

namespace App\Http\Controllers;

use App\Models\Puzzle;
use Illuminate\Http\Request;

class GameController
{
    public function show(Request $request, Puzzle $puzzle)
    {
        if ($request->user()->puzzles()->where('puzzle_id', $puzzle->id)->doesntExist()) {
            $request->user()->puzzles()->attach($puzzle);
        }

        return response()->json([
            'game' => $request->user()->puzzles()->where('puzzle_id', $puzzle->id)->first()->game,
        ]);
    }

    public function update(Request $request, Puzzle $puzzle)
    {
        $request->user()->puzzles()->updateExistingPivot($puzzle->id, [
            'completed_at' => $request->complete ? now() : null,
            'found_words' => $request->found_words,
        ]);

        return response()->json([]);
    }
}
