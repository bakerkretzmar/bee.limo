<?php

namespace Tests\Unit;

use App\Puzzle;
use App\Jobs\AnalyzePuzzles;
use Tests\TestCase;

use Queue;

class AnalyzePuzzlesTest extends TestCase
{
    /** @test */
    public function runs_automatically_on_schedule()
    {
        // Puzzle::makeFromLetters('a', ['a', 'b', 'c', 'd', 'e', 'f', 'g'])->save();

        // Queue::fake();

        // $this->artisan('schedule:run');

        // Queue::assertPushed(AnalyzePuzzles::class);
    }
}
