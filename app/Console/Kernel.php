<?php

namespace App\Console;

use App\Jobs\SolvePuzzles;
use App\Puzzle;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [];

    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new SolvePuzzles(10))
            ->when(Puzzle::unsolved()->exists())
            ->everyTenMinutes()
            ->withoutOverlapping();

        $schedule->command('horizon:snapshot')->everyFiveMinutes();
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
    }
}
