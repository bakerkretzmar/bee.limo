<?php

namespace App\Jobs;

use App\Puzzle;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SolvePuzzles implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public $quantity;

    public function __construct(int $quantity)
    {
        $this->quantity = $quantity;
    }

    public function handle()
    {
        $start = now();

        info('Solving '.$this->quantity.' puzzles...');

        $solved = 0;
        $passed = 0;

        Puzzle::unsolved()->inRandomOrder()->take($this->quantity)->get()
            ->each(function ($puzzle) use (&$solved, &$passed) {
                $pass = $puzzle->solve();
                $passed += (int) $pass;
                $solved++;
            });

        info('Solved '.number_format($solved).' puzzles, found '.number_format($passed).', in '.$start->shortAbsoluteDiffForHumans(now(), 2));
    }
}
