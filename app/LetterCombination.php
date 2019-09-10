<?php

namespace App;

use Arr;
use Illuminate\Database\Eloquent\Builder;

class LetterCombination extends Model
{
    protected $casts = [
        'letters' => 'array',
        'vowels' => 'array',
        'consonants' => 'array',
    ];

    protected $dates = [
        'processed_at',
    ];

    public function getIsProcessedAttribute(): bool
    {
        return ! is_null($this->processed_at);
    }

    public function puzzles()
    {
        return $this->hasMany(Puzzle::class);
    }

    public function markAsProcessed()
    {
        return $this->update(['processed_at' => $this->freshTimestamp()]);
    }

    public function scopeProcessed(Builder $query)
    {
        return $query->whereNotNull('processed_at');
    }

    public function scopeUnprocessed(Builder $query)
    {
        return $query->whereNull('processed_at');
    }

    public static function createFromLetters(array $letters): self
    {
        return static::create([
            'string' => implode('', Arr::sort($letters)),
            'letters' => $letters,
            'vowels' => array_values(array_intersect($letters, vowels())),
            'consonants' => array_values(array_diff($letters, vowels())),
        ]);
    }
}
