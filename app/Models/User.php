<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function puzzles(): BelongsToMany
    {
        return $this->belongsToMany(Puzzle::class)
            ->as('game')
            ->using(Game::class)
            ->withPivot(['found_words', 'completed_at'])
            ->withTimestamps();
    }
}
