<?php

namespace App;

use Arr;

class Word extends Model
{
    protected $casts = [
        'letters' => 'array',
    ];

    public static function boot()
    {
        parent::boot();

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
}
