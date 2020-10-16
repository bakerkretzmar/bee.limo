<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    protected $hidden = ['password', 'remember_token'];

    protected $dates = ['email_verified_at'];

    public function puzzles()
    {
        return $this->belongsToMany(Puzzle::class)
                    ->as('game')
                    ->using(Game::class)
                    ->withPivot([
                        'found_words',
                        'completed_at',
                    ])
                    ->withTimestamps();
    }
}
