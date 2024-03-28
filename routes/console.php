<?php

use App\Console\Commands\SolvePuzzles;
use App\Models\Puzzle;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new SolvePuzzles(10))
    ->when(Puzzle::unsolved()->exists())
    ->everyTenMinutes()
    ->withoutOverlapping();
