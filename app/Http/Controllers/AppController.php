<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class AppController
{
    public function splash()
    {
        return Inertia::render('Splash');
    }

    public function about()
    {
        return Inertia::render('About');
    }
}
