<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Game extends Pivot
{
    protected $appends = [];

    protected $casts = [
        'found_word_ids' => 'array',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'completed_at',
    ];

    public function markWordAsFound(int $id)
    {
        $this->update([
            'found_word_ids' => array_merge($this->found_word_ids, [$id]),
        ]);
    }
}
