<?php

namespace App\Console\Commands;

use App\Word;
use App\Support\WordImporter;

use Illuminate\Console\Command;

class ImportWords extends Command
{
    protected $signature = 'import:words {file}';

    public function handle()
    {
        config(['telescope.enabled' => false]);

        $start = now();

        $this->comment('Importing words from "' . $this->argument('file') . '"...');

        $imported = (new WordImporter($this->argument('file')))->import();

        $this->info('Imported ' . number_format($imported) . ' words in ' . $start->shortAbsoluteDiffForHumans(now(), 2));
        $this->info('Total words: ' . number_format(Word::count()));
    }
}
