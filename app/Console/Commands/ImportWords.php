<?php

namespace App\Console\Commands;

use App\Word;
use App\Support\WordImporter;

use Illuminate\Console\Command;

class ImportWords extends Command
{
    protected $signature = 'import:words {file}';

    protected $description = 'Import words from the given file into the database.';

    public function handle()
    {
        config(['telescope.enabled' => false]);

        $start = now();

        $this->comment('Importing words from "' . $this->argument('file') . '"...');

        $imported = (new WordImporter($this->argument('file')))->import();

        $duration = $start->shortAbsoluteDiffForHumans(now(), 2);

        $this->info('Imported ' . number_format($imported) . ' words in ' . $duration);
        $this->info('Total words: ' . number_format(Word::count()));
    }
}
