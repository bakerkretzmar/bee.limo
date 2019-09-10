<?php

namespace App;

use Arr;

class Word extends Model
{
    protected $casts = [
        'letters' => 'array',
    ];

    public function puzzles()
    {
        return $this->belongsToMany(Puzzle::class);
    }

    public static function createFromString(string $string): self
    {
        return static::create([
            'word' => $string,
            'letters' => array_values(Arr::sort(array_unique(str_split($string)))),
        ]);
    }
}
