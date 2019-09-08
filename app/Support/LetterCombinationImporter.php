<?php

namespace App\Support;

use App\LetterCombination;

class LetterCombinationImporter
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
            $letters = explode(',', $line);

            if (count(array_intersect($letters, vowels()))) {
                $this->store($letters);
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

    protected function store(array $letters): void
    {
        LetterCombination::updateOrCreate(['string' => implode('', $letters)], [
            'letters' => $letters,
            'vowels' => array_values(array_intersect($letters, $this->vowels)),
            'vowel_count' => count(array_intersect($letters, $this->vowels)),
            'consonants' => array_values(array_diff($letters, $this->vowels)),
        ]);
    }
}
