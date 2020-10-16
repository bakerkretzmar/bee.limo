<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $casts = ['email_verified_at'];
    protected $guarded = [];
    protected $hidden = ['password', 'remember_token'];

    public function puzzles()
    {
        return $this->belongsToMany(Puzzle::class)
            ->using(Game::class)
            ->as('game')
            ->withPivot(['found_words', 'completed_at'])
            ->withTimestamps();
    }
}
