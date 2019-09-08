<?php

namespace App\Console\Commands;

use App\Word;
use App\Support\WordImporter;

use Date;
use Illuminate\Console\Command;

class ImportWords extends Command
{
    protected $signature = 'import:words {file}';

    protected $description = 'Import words from the given file into the database';

    public function handle()
    {
        $start = microtime(true);

        $this->comment('Importing words from "' . $this->argument('file') . '"...');

        (new WordImporter(storage_path($this->argument('file'))))->import();

        $end = microtime(true);

        $duration = Date::createFromTimestamp($start)
            ->shortAbsoluteDiffForHumans(Date::createFromTimestamp($end), 2);

        $total = Word::count();

        $this->info('Imported ' . number_format($total) . ' words in ' . $duration);
    }
}
