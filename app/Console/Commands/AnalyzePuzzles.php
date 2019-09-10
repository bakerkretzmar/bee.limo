<?php

namespace App\Console\Commands;

use App\Puzzle;
use App\Support\PuzzleAnalyzer;

use Illuminate\Console\Command;

class AnalyzePuzzles extends Command
{
    protected $signature = 'puzzles:analyze {amount}';

    protected $description = 'Analyze the given number of puzzles.';

    public function handle()
    {
        $start = now();

        if (! Puzzle::unanalyzed()->exists()) {
            $this->question('                                                                               ');
            $this->question('  No puzzles left to analyze! Generate some with the puzzle:generate command.  ');
            return $this->question('                                                                               ');
        }

        $this->comment('Analyzing puzzles...');

        $analyzed = 0;
        $passed = 0;

        Puzzle::unanalyzed()->inRandomOrder()->take($this->argument('amount'))->get()
            ->each(function ($puzzle) use (&$analyzed, &$passed) {
                $pass = (new PuzzleAnalyzer($puzzle))->analyze();
                $passed += $pass ? 1 : 0;
                $analyzed++;
            });

        $duration = $start->shortAbsoluteDiffForHumans(now(), 2);

        $this->info('Analyzed ' . number_format($analyzed) . ' puzzles, found ' . number_format($passed) . ', in ' . $duration);
    }
}
