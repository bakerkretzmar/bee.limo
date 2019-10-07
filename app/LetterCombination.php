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

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->fill([
                'string' => implode('', Arr::sort($model->letters)),
                'vowels' => get_vowels($model->letters),
                'consonants' => get_consonants($model->letters),
            ]);
        });
    }

    public function puzzles()
    {
        return $this->hasMany(Puzzle::class);
    }

    public function getProcessedAttribute(): bool
    {
        return ! is_null($this->processed_at);
    }

    public function markAsProcessed()
    {
        return $this->update(['processed_at' => $this->freshTimestamp()]);
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

    public function scopeUnprocessed(Builder $query)
    {
        return $query->whereNull('processed_at');
    }
}
