<?php

namespace App\Support;

use App\LetterCombination;

use Arr;

class LetterCombinationImporter
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
            $letters = explode(',', $line);

            if (count(array_intersect($letters, vowels()))) {
                $this->store($letters);
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

    protected function store(array $letters): void
    {
        LetterCombination::createFromLetters($letters);
    }
}
