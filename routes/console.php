<?php

use App\Jobs\SolvePuzzles;
use App\Models\LetterCombination;
use App\Models\Puzzle;
use App\Models\Word;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new SolvePuzzles(10))
    ->when(fn () => Puzzle::unsolved()->exists())
    ->everyTenMinutes()
    ->withoutOverlapping();

Artisan::command('puzzles:generate {amount}', function (string $amount): int {
    /** @var \Illuminate\Console\Command $this */
    $start = now();

    if (LetterCombination::unprocessed()->doesntExist()) {
        $this->question('                                                                    ');
        $this->question('  Holy shirt... all known letter combinations have been processed!  ');
        $this->question('                                                                    ');

        return Command::SUCCESS;
    }

    $this->comment('Generating puzzles...');

    $generated = 0;

    LetterCombination::unprocessed()->inRandomOrder()->take(floor(((int) $amount) / 7))->get()
        ->each(function (LetterCombination $letterCombination) use (&$generated) {
            $letterCombination->generatePuzzles();
            $generated += 7;
        });

    $this->info('Generated ' . number_format($generated) . ' puzzles in ' . $start->shortAbsoluteDiffForHumans(now(), 2));

    return Command::SUCCESS;
});

Artisan::command('import:letters {file}', function (string $file): int {
    /** @var \Illuminate\Console\Command $this */
    $this->comment('Importing letter combinations from "' . $file . '"...');

    $start = now();

    $progress = $this->output->createProgressBar((int) head(explode(' ', trim(exec('wc -l ' . $file)))));
    $progress->setFormat('debug');
    $progress->start();

    $lines = function () use ($file) {
        $handle = fopen($file, 'r');

        while (! feof($handle)) {
            yield trim(fgets($handle));
        }

        fclose($handle);
    };

    foreach ($lines() as $line) {
        $progress->advance();

        $letters = explode(',', $line);

        // Ignore letter combinations with no vowels
        if (empty(Arr::vowels($letters))) {
            continue;
        }

        // Ignore letter combinations with more than 2 vowels
        if (count(Arr::vowels($letters)) > 2) {
            continue;
        }

        // Ignore letter combinations containing the letter 's'
        if (in_array('s', $letters)) {
            continue;
        }

        LetterCombination::create(compact('letters'));
    }

    $progress->finish();

    $this->info("\n" . 'Imported ' . number_format(LetterCombination::count()) . ' letter combinations in ' . $start->shortAbsoluteDiffForHumans(now(), 2));

    return Command::SUCCESS;
});

Artisan::command('import:words {file}', function (string $file): int {
    /** @var \Illuminate\Console\Command $this */
    $this->comment('Importing words from "' . $file . '"...');

    $start = now();

    $progress = $this->output->createProgressBar((int) head(explode(' ', trim(exec('wc -l ' . $file)))));
    $progress->setFormat('debug');
    $progress->start();

    $lines = function () use ($file) {
        $handle = fopen($file, 'r');

        while (! feof($handle)) {
            yield trim(fgets($handle));
        }

        fclose($handle);
    };

    foreach ($lines() as $word) {
        $progress->advance();

        // Ignore words shorter than four letters
        if (strlen($word) < 4) {
            continue;
        }

        Word::updateOrCreate(compact('word'));
    }

    $progress->finish();

    $this->info("\n" . 'Imported ' . number_format(Word::count()) . ' words in ' . $start->shortAbsoluteDiffForHumans(now(), 2));

    return Command::SUCCESS;
});

Artisan::command('puzzles:solve {amount}', function (string $amount): int {
    /** @var \Illuminate\Console\Command $this */
    $start = now();

    if (Puzzle::unsolved()->doesntExist()) {
        $this->question('                                                                             ');
        $this->question('  No puzzles left to solve! Generate some with the puzzle:generate command.  ');
        $this->question('                                                                             ');

        return Command::SUCCESS;
    }

    $this->comment('Solving puzzles...');

    $solved = 0;
    $passed = 0;

    Puzzle::unsolved()->inRandomOrder()->take((int) $amount)->get()
        ->each(function (Puzzle $puzzle) use (&$solved, &$passed) {
            $pass = $puzzle->solve();
            $passed += (int) $pass;
            $solved++;
        });

    $this->info('Solved ' . number_format($solved) . ' puzzles, found ' . number_format($passed) . ', in ' . $start->shortAbsoluteDiffForHumans(now(), 2));

    return Command::SUCCESS;
});
