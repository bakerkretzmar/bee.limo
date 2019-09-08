<?php

namespace App\Console\Commands;

use App\Puzzle;
use App\Support\PuzzleAnalyzer;

use Date;
use Illuminate\Console\Command;

class AnalyzePuzzles extends Command
{
    protected $signature = 'puzzles:analyze {amount}';

    protected $description = 'Analyze the given number of puzzles.';

    public function handle()
    {
        $start = microtime(true);

        if (! Puzzle::unanalyzed()->exists()) {
            $this->question('                                                                               ');
            $this->question('  No puzzles left to analyze! Generate some with the puzzle:generate command.  ');
            return $this->question('                                                                               ');
        }

        $this->comment('Analyzing puzzles...');

        $analyzed = 0;

        Puzzle::unanalyzed()->inRandomOrder()->take($this->argument('amount'))->get()
            ->each(function ($puzzle) use (&$analyzed) {
                (new PuzzleAnalyzer($puzzle))->analyze();
                $analyzed++;
            });

        $end = microtime(true);

        $duration = Date::createFromTimestamp($start)
            ->shortAbsoluteDiffForHumans(Date::createFromTimestamp($end), 2);

        $this->info('Analyzed ' . number_format($analyzed) . ' puzzles in ' . $duration);
    }
}
