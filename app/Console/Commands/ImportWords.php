<?php

namespace App\Console\Commands;

use App\Word;
use Illuminate\Console\Command;

class ImportWords extends Command
{
    protected $signature = 'import:words {file}';

    public function handle()
    {
        $this->comment('Importing words from "'.$this->argument('file').'"...');

        $start = now();

        $lines = (int) head(explode(' ', trim(exec('wc -l '.$this->argument('file')))));

        $progress = $this->output->createProgressBar($lines);
        $progress->setFormat('debug');
        $progress->start();

        foreach ($this->lineGenerator() as $word) {
            $progress->advance();

            // Ignore words shorter than four letters
            if (strlen($word) < 4) {
                continue;
            }

            Word::updateOrCreate(compact('word'));
        }

        $progress->finish();

        $this->info("\n".'Imported '.number_format(Word::count()).' words in '.$start->shortAbsoluteDiffForHumans(now(), 2));
    }

    protected function lineGenerator()
    {
        $handle = fopen($this->argument('file'), 'r');

        while (!feof($handle)) {
            yield trim(fgets($handle));
        }

        fclose($handle);
    }
}
