<?php

namespace Tests\Unit;

use App\LetterCombination;
use App\Puzzle;
use App\Support\PuzzleGenerator;
use Tests\TestCase;

class PuzzleGeneratorTest extends TestCase
{
    /** @test */
    public function can_generate_puzzles_based_on_letter_combination()
    {
        $letterCombination = LetterCombination::create([
            'string' => 'abcdefg',
            'letters' => ['a', 'b', 'c', 'd', 'e', 'f', 'g'],
            'vowels' => ['a', 'e'],
            'vowel_count' => 2,
            'consonants' => ['b', 'c', 'd', 'f', 'g'],
        ]);

        (new PuzzleGenerator($letterCombination))->generate();

        // dump($letterCombination->puzzles);

        $this->assertTrue(Puzzle::where('string', 'abcdefg')->exists());
        $this->assertTrue(Puzzle::where('string', 'bacdefg')->exists());
        $this->assertTrue(Puzzle::where('string', 'cabdefg')->exists());
        $this->assertTrue(Puzzle::where('string', 'dabcefg')->exists());
        $this->assertTrue(Puzzle::where('string', 'eabcdfg')->exists());
        $this->assertTrue(Puzzle::where('string', 'fabcdeg')->exists());
        $this->assertTrue(Puzzle::where('string', 'gabcdef')->exists());
    }
}
