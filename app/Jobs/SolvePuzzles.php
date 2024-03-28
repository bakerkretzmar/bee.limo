<?php

namespace App\Jobs;

use App\Models\Puzzle;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SolvePuzzles implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public int $quantity,
    ) {}

    public function handle(): void
    {
        $start = now();

        Log::info("Solving {$this->quantity} puzzles...");

        $solved = 0;
        $passed = 0;

        Puzzle::unsolved()->inRandomOrder()->take($this->quantity)->get()
            ->each(function (Puzzle $puzzle) use (&$solved, &$passed) {
                $pass = $puzzle->solve();
                $passed += (int) $pass;
                $solved++;
            });

        Log::info(vsprintf('Solved %s puzzles, found %s, in %s', [
            number_format($solved),
            number_format($passed),
            $start->shortAbsoluteDiffForHumans(now(), 2),
        ]));
    }
}
