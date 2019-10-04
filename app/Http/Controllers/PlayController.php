<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class PlayController
{
    public function __invoke()
    {
        return Inertia::render('Play', [
            // 'event' => $event->only('id', 'title', 'start_date', 'description'),
        ]);
    }
}
