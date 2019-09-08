<?php

namespace App;

class Word extends Model
{
    protected $casts = [
        'letters' => 'array',
    ];
}
