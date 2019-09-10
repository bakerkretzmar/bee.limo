<?php

namespace App\Support;

use App\Puzzle;
use App\Word;

class PuzzleAnalyzer
{
    protected $puzzle;

    protected $words;

    protected $start;

    public function __construct(Puzzle $puzzle)
    {
        $this->puzzle = $puzzle;
    }

    public function analyze(): bool
    {
        $this->start = now();

        if (! $this->puzzle->hasPangram()) {
            return $this->fail('No pangram.');
        }

        $forbidden = array_values(array_diff(letters(), $this->puzzle->letters));

        $this->words = tap(
            Word::whereJsonContains('letters', $this->puzzle->initial),
            function ($query) use ($forbidden) {
                foreach ($forbidden as $letter) {
                    $query->whereJsonDoesntContain('letters', $letter);
                }
            }
        )->get();

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
                return $carry + strlen($word->word);
            }) / $this->words->count(),
            'max_word_length' => max($this->words->map(function ($word) {
                return strlen($word->word);
            })->all()),
            'duration' => $this->start->floatDiffInSeconds(now()),
        ];

        $this->puzzle->markAsAnalyzed();
        $this->puzzle->update(compact('analysis'));

        return true;
    }

    protected function fail(string $summary, array $analysis = []): bool
    {
        $this->puzzle->markAsAnalyzed();

        $this->puzzle->update(['analysis' => array_merge([
            'result' => 'fail',
            'summary' => $summary,
            'duration' => $this->start->floatDiffInSeconds(now()),
        ], $analysis)]);

        $this->puzzle->delete();

        return false;
    }
}
