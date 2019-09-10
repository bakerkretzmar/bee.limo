<?php

namespace App;

use Arr;
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
        return Word::whereJsonContains('letters', $this->letters)
                   ->whereJsonLength('letters', 7)
                   ->exists();
    }

    public function getPangramsAttribute()
    {
        return Word::whereJsonContains('letters', $this->letters)
                   ->whereJsonLength('letters', 7)
                   ->get();
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
        return new static([
            'string' => $initial . implode('', Arr::sort(array_values(array_diff($letters, [$initial])))),
            'initial' => $initial,
            'letters' => $letters,
        ]);
    }
}
