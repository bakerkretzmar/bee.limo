<?php

namespace App;

class LetterCombination extends Model
{
    protected $casts = [
        'letters' => 'array',
        'vowels' => 'array',
        'vowel_count' => 'integer',
        'consonants' => 'array',
    ];
}
