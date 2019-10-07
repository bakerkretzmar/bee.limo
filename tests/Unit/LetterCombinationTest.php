<?php

namespace Tests\Unit;

use App\LetterCombination;
use App\Puzzle;
use Tests\TestCase;

class LetterCombinationTest extends TestCase
{
    /** @test */
    public function infers_attributes_when_creating()
    {
        $letter_combination = LetterCombination::create([
            'letters' => ['a', 'b', 'c', 'd', 'e', 'f', 'g'],
        ]);

        $this->assertSame('abcdefg', $letter_combination->string);
        $this->assertSame(['a', 'e'], $letter_combination->vowels);
        $this->assertSame(['b', 'c', 'd', 'f', 'g'], $letter_combination->consonants);
    }

    /** @test */
    public function can_generate_puzzles()
    {
        $letter_combination = LetterCombination::create([
            'letters' => ['a', 'b', 'c', 'd', 'e', 'f', 'g'],
        ]);

        $letter_combination->generatePuzzles();

        $this->assertTrue($letter_combination->processed);
        foreach (['abcdefg', 'bacdefg', 'cabdefg', 'dabcefg', 'eabcdfg', 'fabcdeg', 'gabcdef'] as $combo) {
            $this->assertTrue(Puzzle::where('string', $combo)->exists());
        }
    }
}
