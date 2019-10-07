<?php

namespace App\Console\Commands;

use App\LetterCombination;
use App\Support\LetterCombinationImporter;

use Illuminate\Console\Command;

class ImportLetterCombinations extends Command
{
    protected $signature = 'import:letters {file}';

    public function handle()
    {
        config(['telescope.enabled' => false]);

        $start = now();

        $this->comment('Importing letter combinations from "' . $this->argument('file') . '"...');

        $imported = (new LetterCombinationImporter($this->argument('file')))->import();

        $this->info('Imported ' . number_format($imported) . ' letter combinations in ' . $start->shortAbsoluteDiffForHumans(now(), 2));
        $this->info('Total letter combinations: ' . number_format(LetterCombination::count()));
    }
}
