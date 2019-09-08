<?php

namespace App;

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
            'letters' => str_split($string),
            'letter_1' => str_split($string)[0],
            'letter_2' => str_split($string)[1],
        ]);
    }
}
