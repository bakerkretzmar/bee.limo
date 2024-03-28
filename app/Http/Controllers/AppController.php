<?php

namespace App\Http\Controllers;

class AppController
{
    public function splash()
    {
        return inertia('Splash');
    }

    public function about()
    {
        return inertia('About');
    }
}
