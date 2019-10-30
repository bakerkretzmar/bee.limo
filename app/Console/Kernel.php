<?php

namespace App\Console;

use App\Puzzle;
use App\Jobs\SolvePuzzles;

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

        $schedule->command('telescope:prune --hours=336')->daily();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
