<?php

namespace App\Support;

use App\Word;

use Arr;

class WordImporter
{
    protected $file;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    public function import()
    {
        $count = 0;

        foreach ($this->lineGenerator() as $line) {
            // Ignore words shorter than four letters
            if (strlen($line) < 4) {
                continue;
            }

            $this->store($line);
            $count++;
        }

        return $count;
    }

    protected function lineGenerator()
    {
        $handle = fopen($this->file, 'r');

        while(! feof($handle)) {
            yield trim(fgets($handle));
        }

        fclose($handle);
    }

    protected function store(string $word): void
    {
        Word::updateOrCreate(compact('word'));
    }
}
