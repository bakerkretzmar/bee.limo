<?php

namespace App\Jobs;

use App\Puzzle;
use App\Support\PuzzleAnalyzer;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class AnalyzePuzzles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $quantity;

    public function __construct(int $quantity)
    {
        $this->quantity = $quantity;
    }

    public function handle()
    {
        $start = now();
        info('Analyzing ' . $this->quantity . ' puzzles...');

        $analyzed = 0; $passed = 0;

        Puzzle::unanalyzed()->inRandomOrder()->take($this->quantity)->get()
            ->each(function ($puzzle) use (&$analyzed, &$passed) {
                $pass = (new PuzzleAnalyzer($puzzle))->analyze();
                $analyzed++; $passed += $pass ? 1 : 0;
            });

        $duration = $start->shortAbsoluteDiffForHumans(now(), 2);
        info('Analyzed ' . number_format($analyzed) . ' puzzles, found ' . number_format($passed) . ', in ' . $duration);
    }
}
