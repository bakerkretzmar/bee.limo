<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Inertia::version(function () {
            return md5_file(public_path('mix-manifest.json'));
        });
    }
}
