<?php

namespace App\Providers;

use Session;
use Illuminate\Support\ServiceProvider;

use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Inertia::version(function () {
            return md5_file(public_path('mix-manifest.json'));
        });

        Inertia::share([
            'errors' => function () {
                return Session::has('errors') ? Session::get('errors')->getBag('default')->getMessages() : (object) [];
            },
            'user' => function () {
                return auth()->user();
            },
        ]);
    }
}
