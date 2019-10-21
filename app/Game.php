<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Game extends Pivot
{
    protected $appends = [];

    protected $casts = [
        'found_words' => 'array',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'completed_at',
    ];
}
