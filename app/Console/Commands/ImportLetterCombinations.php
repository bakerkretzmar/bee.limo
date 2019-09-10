<?php

namespace App\Console\Commands;

use App\LetterCombination;
use App\Support\LetterCombinationImporter;

use Illuminate\Console\Command;

class ImportLetterCombinations extends Command
{
    protected $signature = 'import:letter-combinations {file}';

    protected $description = 'Import letter combinations from the given file into the database.';

    public function handle()
    {
        config(['telescope.enabled' => false]);

        $start = now();

        $this->comment('Importing letter combinations from "' . $this->argument('file') . '"...');

        $imported = (new LetterCombinationImporter($this->argument('file')))->import();

        $duration = $start->shortAbsoluteDiffForHumans(now(), 2);

        $this->info('Imported ' . number_format($imported) . ' letter combinations in ' . $duration);
        $this->info('Total letter combinations: ' . number_format(LetterCombination::count()));
    }
}
