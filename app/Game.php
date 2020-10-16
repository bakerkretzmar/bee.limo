<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Game extends Pivot
{
    protected $casts = [
        'completed_at' => 'datetime',
        'created_at' => 'datetime',
        'found_words' => 'array',
        'updated_at' => 'datetime',
    ];
}
