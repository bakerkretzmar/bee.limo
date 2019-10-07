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
        $count = 0;

        foreach ($this->lineGenerator() as $line) {
            $letters = explode(',', $line);

            // Ignore letter combinations with no vowels
            if (empty(get_vowels($letters))) {
                continue;
            }

            $this->store($letters);
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

    protected function store(array $letters): void
    {
        LetterCombination::create(compact('letters'));
    }
}
