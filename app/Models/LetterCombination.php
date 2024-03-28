<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;

class LetterCombination extends Model
{
    protected $casts = [
        'consonants' => 'array',
        'letters' => 'array',
        'processed_at' => 'datetime',
        'vowels' => 'array',
    ];

    protected static function booted(): void
    {
        static::creating(function (LetterCombination $letterCombination) {
            $letterCombination->fill([
                'string' => implode('', Arr::sort($letterCombination->letters)),
                'vowels' => Arr::vowels($letterCombination->letters),
                'consonants' => Arr::consonants($letterCombination->letters),
            ]);
        });
    }

    public function puzzles(): HasMany
    {
        return $this->hasMany(Puzzle::class);
    }

    public function getProcessedAttribute(): bool
    {
        return ! is_null($this->processed_at);
    }

    public function markAsProcessed()
    {
        return $this->touch('processed_at');
    }

    public function generatePuzzles(): void
    {
        foreach ($this->letters as $initial) {
            $this->puzzles()->save(
                Puzzle::make(['letters' => array_merge([$initial], array_diff($this->letters, [$initial]))])
            );
        }

        $this->markAsProcessed();
    }

    public function scopeUnprocessed(Builder $query): void
    {
        $query->whereNull('processed_at');
    }
}
