<?php

namespace App\Console\Commands;

use App\LetterCombination;
use App\Puzzle;
use App\Support\PuzzleGenerator;

use Illuminate\Console\Command;

class GeneratePuzzles extends Command
{
    protected $signature = 'puzzles:generate {amount}';

    protected $description = 'Generate the given number of puzzles.';

    public function handle()
    {
        $start = now();

        $this->comment('Generating puzzles...');

        $generated = 0;
        $amount = ($this->argument('amount') - ($this->argument('amount') % 7)) / 7;

        LetterCombination::unprocessed()->inRandomOrder()->take($amount)->get()
            ->each(function ($letterCombination) use (&$generated) {
                (new PuzzleGenerator($letterCombination))->generate();
                $generated += 7;
            });

        $duration = $start->shortAbsoluteDiffForHumans(now(), 2);

        $this->info('Generated ' . number_format($generated) . ' puzzles in ' . $duration);
    }
}
