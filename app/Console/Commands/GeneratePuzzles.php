<?php

namespace App\Console\Commands;

use App\LetterCombination;
use App\Puzzle;
use App\Support\PuzzleGenerator;

use Date;
use Illuminate\Console\Command;

class GeneratePuzzles extends Command
{
    protected $signature = 'puzzles:generate {amount}';

    protected $description = 'Generate the given number of puzzles.';

    public function handle()
    {
        $start = microtime(true);

        $this->comment('Generating puzzles...');

        $generated = 0;
        $amount = ($this->argument('amount') - ($this->argument('amount') % 7)) / 7;

        LetterCombination::unprocessed()->inRandomOrder()->take($amount)
            ->each(function (LetterCombination $LetterCombination) {
                (new PuzzleGenerator($LetterCombination))->generate();
                $generated += 7;
            });

        $end = microtime(true);

        $duration = Date::createFromTimestamp($start)
            ->shortAbsoluteDiffForHumans(Date::createFromTimestamp($end), 2);

        $this->info('Generated ' . number_format($generated) . ' puzzles in ' . $duration);
    }
}
