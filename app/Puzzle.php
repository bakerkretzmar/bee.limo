<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Puzzle extends Model
{
    use SoftDeletes;

    protected $casts = [
        'letters' => 'array',
        'analysis' => 'array',
    ];

    protected $dates = [
        'solved_at',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->fill([
                'string' => implode('', $model->letters),
                'initial' => head($model->letters),
            ]);
        });
    }

    public function letterCombination()
    {
        return $this->belongsTo(LetterCombination::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->as('game')
                    ->using(Game::class)
                    ->withPivot([
                        'found_words',
                        'completed_at',
                    ])
                    ->withTimestamps();
    }

    public function words()
    {
        return $this->belongsToMany(Word::class);
    }

    public function getSolvedAttribute(): bool
    {
        return ! is_null($this->solved_at);
    }

    public function hasPangram(): bool
    {
        return Word::whereJsonContains('letters', $this->letters)
            ->whereJsonLength('letters', 7)
            ->exists();
    }

    public function getPangramsAttribute()
    {
        $letters = $this->letters;

        return $this->words->filter(function ($word) use ($letters) {
            return array_intersect($letters, $word->letters) === $letters;
        })->values();
    }

    public function solve(): bool
    {
        $start = now();

        // Fail if the puzzle doesn't have a pangram
        if (! $this->hasPangram()) {
            $this->update([
                'solved_at' => $this->freshTimestamp(),
                'analysis' => [
                    'result' => 'fail',
                    'summary' => 'No pangram.',
                ],
            ]);

            $this->delete();

            return false;
        }

        $words = tap(
            Word::whereJsonContains('letters', $this->initial),
            function ($query) {
                foreach (array_values(array_diff(letters(), $this->letters)) as $forbidden) {
                    $query->whereJsonDoesntContain('letters', $forbidden);
                }
            }
        )->get();

        // Fail if the puzzle has fewer than 15 words
        if ($words->count() < 15) {
            $this->update([
                'solved_at' => $this->freshTimestamp(),
                'analysis' => [
                    'result' => 'fail',
                    'summary' => 'Fewer than 15 words.',
                    'word_count' => $words->count(),
                ],
            ]);

            $this->delete();

            return false;
        }

        $this->words()->sync($words);

        $this->update([
            'solved_at' => $this->freshTimestamp(),
            'analysis' => [
                'result' => 'pass',
                'word_count' => $words->count(),
                'avg_word_length' => round($words->reduce(function ($carry, $word) {
                    return $carry + strlen($word->word);
                }) / $words->count(), 3),
                'max_word_length' => max($words->map(function ($word) {
                    return strlen($word->word);
                })->all()),
            ],
        ]);

        return true;
    }

    public function scopeSolved(Builder $query)
    {
        return $query->whereNotNull('solved_at');
    }

    public function scopeUnsolved(Builder $query)
    {
        return $query->whereNull('solved_at');
    }
}
