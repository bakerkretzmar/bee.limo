<?php

namespace App\Console\Commands;

use App\LetterCombination;

use Illuminate\Console\Command;

class ImportLetterCombinations extends Command
{
    protected $signature = 'import:letters {file}';

    public function handle()
    {
        $this->comment('Importing letter combinations from "' . $this->argument('file') . '"...');

        $start = now();

        $lines = (int) head(explode(' ', trim(exec('wc -l ' . $this->argument('file')))));

        $progress = $this->output->createProgressBar($lines);
        $progress->setFormat('debug');
        $progress->start();

        foreach ($this->lineGenerator() as $line) {
            $progress->advance();

            $letters = explode(',', $line);

            // Ignore letter combinations with no vowels
            if (empty(get_vowels($letters))) {
                continue;
            }

            // Ignore letter combinations with more than 2 vowels
            if (count(get_vowels($letters)) > 2) {
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
    }

    protected function lineGenerator()
    {
        $handle = fopen($this->argument('file'), 'r');

        while (! feof($handle)) {
            yield trim(fgets($handle));
        }

        fclose($handle);
    }
}
