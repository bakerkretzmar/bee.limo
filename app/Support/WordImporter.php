<?php

namespace App\Support;

use App\Word;

class WordImporter
{
    protected $file;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    public function import()
    {
        $buffer = '';

        foreach ($this->readLines() as $line) {
            if (strlen($line) >= 4) {
                $this->store($line);
            }
        }
    }

    protected function readLines()
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
            'letter_1' => str_split($line)[0],
            'letter_2' => str_split($line)[1],
            'letters' => str_split($line),
        ]);
    }
}
