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
            'letter_1' => str_split($line)[0],
            'letter_2' => str_split($line)[1],
            'letters' => str_split($line),
        ]);
    }
}
