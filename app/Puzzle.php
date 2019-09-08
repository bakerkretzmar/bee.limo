<?php

namespace App;

use Arr;
use Illuminate\Database\Eloquent\Builder;

class Puzzle extends Model
{
    protected $casts = [
        'others' => 'array',
        'letters' => 'array',
    ];

    protected $dates = [
        'analyzed_at',
    ];

    public function getIsAnalyzedAttribute(): bool
    {
        return ! is_null($this->analyzed_at);
    }

    public function letterCombination()
    {
        return $this->belongsTo(LetterCombination::class);
    }

    public function words()
    {
        return $this->belongsToMany(Word::class);
    }

    public function markAsAnalyzed()
    {
        return $this->update(['analyzed_at' => $this->freshTimestamp()]);
    }

    public function hasPangram(): bool
    {
        return Word::whereJsonContains('letters', $this->letters)->exists();
    }

    public function analyze(): void
    {

    }

    public function scopeAnalyzed(Builder $query)
    {
        return $query->whereNotNull('analyzed_at');
    }

    public function scopeUnanalyzed(Builder $query)
    {
        return $query->whereNull('analyzed_at');
    }

    public static function makeFromLetters(string $initial, array $letters): self
    {
        $others = array_values(array_diff($letters, [$initial]));

        return new static([
            'string' => $initial . implode('', Arr::sort($others)),
            'initial' => $initial,
            'others' => $others,
            'letters' => $letters,
        ]);
    }
}
