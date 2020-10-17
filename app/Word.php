<?php

namespace App;

use Illuminate\Support\Arr;

class Word extends Model
{
    protected $appends = ['score'];
    protected $casts = [
        'letters' => 'array',
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->fill([
                'letters' => array_values(Arr::sort(array_unique(str_split($model->word)))),
            ]);
        });
    }

    public function puzzles()
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
