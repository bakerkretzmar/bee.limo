<?php

namespace App\Http\Controllers;

class DashboardController
{
    public function __invoke()
    {
        return inertia('Dashboard', [
            // 'event' => $event->only('id', 'title', 'start_date', 'description'),
        ]);
    }
}
