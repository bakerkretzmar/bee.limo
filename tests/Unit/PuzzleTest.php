<?php

namespace Tests\Unit;

use App\LetterCombination;
use App\Puzzle;
use App\Word;
use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

class PuzzleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_check_if_pangram_exists()
    {
        $letters = ['i', 'v', 'e', 't', 'n', 'c', 'z'];
        $letterCombination = LetterCombination::createFromLetters($letters);
        $letterCombination->puzzles()->save(
            $puzzle = Puzzle::makeFromLetters($letters[0], $letters)
        );

        Word::createFromString('incentivize');

        $this->assertTrue($puzzle->hasPangram());
    }

    /** @test */
    public function can_check_if_pangram_doesnt_exist()
    {
        $letters = ['i', 'v', 'e', 't', 'n', 'c', 'z'];
        $letterCombination = LetterCombination::createFromLetters($letters);
        $letterCombination->puzzles()->save(
            $puzzle = Puzzle::makeFromLetters($letters[0], $letters)
        );

        Word::createFromString('invite');
        Word::createFromString('incentive');
        Word::createFromString('zinc');
        Word::createFromString('incite');
        Word::createFromString('zoomy');
        Word::createFromString('accept');

        $this->assertFalse($puzzle->hasPangram());
    }
}
