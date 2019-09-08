<?php

namespace App\Support;

use InvalidArgumentException;

use App\Puzzle;
use App\LetterCombination;

use Arr;

class PuzzleGenerator
{
    protected $letterCombination;

    public function __construct(LetterCombination $letterCombination)
    {
        if ($letterCombination->is_processed) {
            throw new InvalidArgumentException('The given letter combination has already been processed.');
        }

        $this->letterCombination = $letterCombination;
    }

    public function generate()
    {
        $letters = $this->letterCombination->letters;

        foreach ($letters as $initial) {
            $this->letterCombination->puzzles()->save(
                Puzzle::makeFromLetters($initial, $letters)
            );
        }

        $this->letterCombination->markAsProcessed();
    }
}
