<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;

class Puzzle extends Model
{
    use SoftDeletes;

    protected $casts = [
        'analysis' => 'array',
        'letters' => 'array',
        'solved_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Puzzle $puzzle) {
            $puzzle->fill([
                'string' => implode('', $puzzle->letters),
                'initial' => head($puzzle->letters),
            ]);
        });
    }

    public function letterCombination(): BelongsTo
    {
        return $this->belongsTo(LetterCombination::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->as('game')
            ->using(Game::class)
            ->withPivot(['found_words', 'completed_at'])
            ->withTimestamps();
    }

    public function words(): BelongsToMany
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
        return $this->words->filter(function ($word) {
            return array_intersect($this->letters, $word->letters) === $this->letters;
        })->values();
    }

    public function solve(): bool
    {
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
                foreach (array_values(array_diff(Arr::letters(), $this->letters)) as $forbidden) {
                    $query->whereJsonDoesntContain('letters', $forbidden);
                }
            }
        )->get();

        // Fail if the puzzle has fewer than 20 words
        if ($words->count() < 20) {
            $this->update([
                'solved_at' => $this->freshTimestamp(),
                'analysis' => [
                    'result' => 'fail',
                    'summary' => 'Fewer than 20 words.',
                    'word_count' => $words->count(),
                ],
            ]);

            $this->delete();

            return false;
        }

        $pangrams = $words->filter(function ($word) {
            return array_intersect($this->letters, $word->letters) === $this->letters;
        })->values();

        // Fail if all non-pangram words together don't contain all 7 letters of
        // the puzzle (i.e. any letters in the puzzle *only* appear in a pangram)
        if ($words->diff($pangrams)->pluck('letters')->collapse()->unique()->count() < 7) {
            $this->update([
                'solved_at' => $this->freshTimestamp(),
                'analysis' => [
                    'result' => 'fail',
                    'summary' => 'Some letters only present in pangrams.',
                    'word_count' => $words->count(),
                ],
            ]);

            $this->delete();

            return false;
        }

        $this->words()->sync($words);

        $total_points = $words->sum('score') + ($pangrams->count() * 7);
        $pangram_points = $pangrams->sum('score') + ($pangrams->count() * 7);

        $this->update([
            'solved_at' => $this->freshTimestamp(),
            'analysis' => [
                'result' => 'pass',
                'word_count' => $words->count(),
                'pangram_count' => $pangrams->count(),
                'genius_score' => (int) ($total_points * 0.70),
                'max_score' => $total_points,
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

    public function scopeSolved(Builder $query): void
    {
        $query->whereNotNull('solved_at');
    }

    public function scopeUnsolved(Builder $query): void
    {
        $query->whereNull('solved_at');
    }
}
