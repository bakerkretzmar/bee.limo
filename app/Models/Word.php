<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;

class Word extends Model
{
    protected $appends = [
        'score',
    ];

    protected $casts = [
        'letters' => 'array',
    ];

    protected static function booted(): void
    {
        static::creating(function (Word $word) {
            $word->fill([
                'letters' => array_values(Arr::sort(array_unique(str_split($word->word)))),
            ]);
        });
    }

    public function puzzles(): BelongsToMany
    {
        return $this->belongsToMany(Puzzle::class);
    }

    public function getScoreAttribute(): int
    {
        if (strlen($this->word) === 4) {
            return 1;
        }

        return strlen($this->word);
    }
}
