<?php

namespace App\Console\Commands;

use App\Puzzle;

use Illuminate\Console\Command;

class SolvePuzzles extends Command
{
    protected $signature = 'puzzles:solve {amount}';

    public function handle()
    {
        $start = now();

        if (Puzzle::unsolved()->doesntExist()) {
            $this->question('                                                                             ');
            $this->question('  No puzzles left to solve! Generate some with the puzzle:generate command.  ');
            return $this->question('                                                                             ');
        }

        $this->comment('Solving puzzles...');

        $solved = 0; $passed = 0;

        Puzzle::unsolved()->inRandomOrder()->take($this->argument('amount'))->get()
            ->each(function ($puzzle) use (&$solved, &$passed) {
                $pass = $puzzle->solve();
                $passed += (int) $pass;
                $solved++;
            });

        $this->info('Solved ' . number_format($solved) . ' puzzles, found ' . number_format($passed) . ', in ' . $start->shortAbsoluteDiffForHumans(now(), 2));
    }
}
