<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class AppController
{
    public function __invoke()
    {
        return Inertia::render('Welcome', [
            // 'event' => $event->only('id', 'title', 'start_date', 'description'),
        ]);
    }
}
