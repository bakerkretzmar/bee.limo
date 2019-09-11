<?php

namespace Tests\Unit;

use App\LetterCombination;
use App\Puzzle;
use App\Jobs\AnalyzePuzzles;
use Tests\TestCase;

use Date;
use Queue;

class AnalyzePuzzlesTest extends TestCase
{
    /** @test */
    public function runs_automatically_on_schedule()
    {
        // $letterCombination = LetterCombination::createFromLetters(['i', 'v', 'e', 't', 'n', 'c', 'z']);
        // $puzzle = Puzzle::makeFromLetters('i', ['i', 'v', 'e', 't', 'n', 'c', 'z']);
        // $letterCombination->puzzles()->save($puzzle);

        // Queue::fake();

        // $this->artisan('schedule:run');
        // Date::setTestNow(now()->addMinutes(10));
        // $this->artisan('schedule:run');

        // Queue::assertPushed(AnalyzePuzzles::class);
    }
}
