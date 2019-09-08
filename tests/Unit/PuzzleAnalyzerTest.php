<?php

namespace Tests\Unit;

use App\LetterCombination;
use App\Puzzle;
use App\Word;
use App\Support\PuzzleAnalyzer;
use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

class PuzzleAnalyzerTest extends TestCase
{
    use RefreshDatabase;

    protected $letters = ['i', 'v', 'e', 't', 'n', 'c', 'z'];

    protected $letterCombination;

    protected $puzzle;

    protected function setUp(): void
    {
        parent::setUp();

        $this->letterCombination = LetterCombination::createFromLetters($this->letters);
        $this->puzzle = Puzzle::makeFromLetters($this->letters[0], $this->letters);
        $this->letterCombination->puzzles()->save($this->puzzle);
    }

    /** @test */
    public function fails_puzzle_with_no_pangram()
    {
        Word::createFromString('invite');
        Word::createFromString('incentive');
        Word::createFromString('zinc');
        Word::createFromString('incite');
        Word::createFromString('zoomy');
        Word::createFromString('accept');

        (new PuzzleAnalyzer($this->puzzle))->analyze();
        $this->puzzle->refresh();

        $this->assertTrue($this->puzzle->is_analyzed);
        $this->assertSame(
            [
                'result' => 'fail',
                'summary' => 'No pangram.',
            ],
            $this->puzzle->analysis
        );
        $this->assertTrue($this->puzzle->trashed());
    }

    /** @test */
    public function fails_puzzle_with_fewer_than_fifteen_words()
    {
        Word::createFromString('invite');
        Word::createFromString('incentive');
        Word::createFromString('incentivize');
        Word::createFromString('intent');
        Word::createFromString('nice');
        Word::createFromString('nine');
        Word::createFromString('cite');
        Word::createFromString('citizen');
        Word::createFromString('civic');
        Word::createFromString('entice');
        Word::createFromString('evict');
        Word::createFromString('evince');
        Word::createFromString('zinc');
        Word::createFromString('incite');
        Word::createFromString('zoomy');
        Word::createFromString('accept');

        (new PuzzleAnalyzer($this->puzzle))->analyze();
        $this->puzzle->refresh();

        $this->assertTrue($this->puzzle->is_analyzed);
        $this->assertSame(
            [
                'result' => 'fail',
                'summary' => 'Fewer than 15 words.',
                'word_count' => 14,
            ],
            $this->puzzle->analysis
        );
        $this->assertTrue($this->puzzle->trashed());
    }

    /** @test */
    public function passes_valid_puzzle()
    {
        Word::createFromString('invite');
        Word::createFromString('incentive');
        Word::createFromString('incentivize');
        Word::createFromString('intent');
        Word::createFromString('nice');
        Word::createFromString('nine');
        Word::createFromString('cite');
        Word::createFromString('citizen');
        Word::createFromString('civic');
        Word::createFromString('entice');
        Word::createFromString('evict');
        Word::createFromString('evince');
        Word::createFromString('zinc');
        Word::createFromString('incite');
        Word::createFromString('zoomy');
        Word::createFromString('accept');
        Word::createFromString('ziti');

        (new PuzzleAnalyzer($this->puzzle))->analyze();
        $this->puzzle->refresh();

        $this->assertTrue($this->puzzle->is_analyzed);
        $this->assertEqualsCanonicalizing(
            [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 17],
            $this->puzzle->words->pluck('id')->all()
        );
        $this->assertSame(
            [
                'result' => 'pass',
                'summary' => 'Analysis successful.',
                'word_count' => 15,
                'avg_word_length' => 5.8,
                'max_word_length' => 11,
            ],
            $this->puzzle->analysis
        );
        $this->assertFalse($this->puzzle->trashed());
    }
}
