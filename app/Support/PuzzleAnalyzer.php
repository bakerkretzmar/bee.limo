<?php

namespace App\Support;

use App\Puzzle;
use App\Word;

class PuzzleAnalyzer
{
    protected $puzzle;

    protected $words;

    public function __construct(Puzzle $puzzle)
    {
        $this->puzzle = $puzzle;
    }

    public function analyze()
    {
        if (! $this->puzzle->hasPangram()) {
            return $this->fail('No pangram.');
        }

        $forbidden = array_values(array_diff(letters(), $this->puzzle->letters));

        $this->words = Word::whereJsonContains('letters', $this->puzzle->initial)
                           ->whereJsonDoesntContain('letters', $forbidden)
                           ->get();

        if ($this->words->count() < 15) {
            return $this->fail('Fewer than 15 words.', [
                'word_count' => $this->words->count(),
            ]);
        }

        $this->puzzle->words()->sync($this->words);

        $analysis = [
            'result' => 'pass',
            'summary' => 'Analysis successful.',
            'word_count' => $this->words->count(),
            'avg_word_length' => $this->words->reduce(function ($carry, $word) {
                return $carry + count($word->letters);
            }) / $this->words->count(),
            'max_word_length' => max($this->words->map(function ($word) {
                return count($word->letters);
            })->all()),
        ];

        $this->puzzle->markAsAnalyzed();
        $this->puzzle->update(compact('analysis'));
    }

    protected function fail(string $summary, array $analysis = [])
    {
        $this->puzzle->markAsAnalyzed();

        $this->puzzle->update(['analysis' => array_merge([
            'result' => 'fail',
            'summary' => $summary,
        ], $analysis)]);

        $this->puzzle->delete();
    }
}
