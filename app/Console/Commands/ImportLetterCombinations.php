<?php

namespace App\Console\Commands;

use App\LetterCombination;
use App\Support\LetterCombinationImporter;

use Date;
use Illuminate\Console\Command;

class ImportLetterCombinations extends Command
{
    protected $signature = 'import:letter-combinations {file}';

    protected $description = 'Import letter combinations from the given file into the database';

    public function handle()
    {
        $start = microtime(true);

        $this->comment('Importing letter combinations from "' . $this->argument('file') . '"...');

        (new LetterCombinationImporter(storage_path($this->argument('file'))))->import();

        $end = microtime(true);

        $duration = Date::createFromTimestamp($start)
            ->shortAbsoluteDiffForHumans(Date::createFromTimestamp($end), 2);

        $total = LetterCombination::count();

        $this->info('Imported ' . number_format($total) . ' letter combinations in ' . $duration);
    }
}
