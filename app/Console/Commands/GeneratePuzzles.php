<?php

namespace App\Console\Commands;

use App\LetterCombination;

use Illuminate\Console\Command;

class GeneratePuzzles extends Command
{
    protected $signature = 'puzzles:generate {amount}';

    public function handle()
    {
        $start = now();

        if (LetterCombination::unprocessed()->doesntExist()) {
            $this->question('                                                                    ');
            $this->question('  Holy shirt... all known letter combinations have been processed!  ');

            return $this->question('                                                                    ');
        }

        $this->comment('Generating puzzles...');

        $generated = 0;

        LetterCombination::unprocessed()->inRandomOrder()->take(floor($this->argument('amount') / 7))->get()
            ->each(function ($letter_combination) use (&$generated) {
                $letter_combination->generatePuzzles();
                $generated += 7;
            });

        $this->info('Generated ' . number_format($generated) . ' puzzles in ' . $start->shortAbsoluteDiffForHumans(now(), 2));
    }
}
