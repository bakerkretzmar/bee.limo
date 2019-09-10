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
        $counter = 0;

        foreach ($this->lineGenerator() as $line) {
            if (strlen($line) >= 4) {
                $this->store($line);
                $counter++;
            }
        }

        return $counter;
    }

    protected function lineGenerator()
    {
        $handle = fopen($this->file, 'r');

        while(! feof($handle)) {
            yield trim(fgets($handle));
        }

        fclose($handle);
    }

    protected function store(string $line): void
    {
        Word::updateOrCreate(['word' => $line], [
            'letters' => array_values(Arr::sort(array_unique(str_split($line)))),
        ]);
    }
}
