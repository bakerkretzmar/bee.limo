<?php

namespace App\Providers;

use Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    protected function mapApiRoutes()
    {
        Route::group([
            'as' => 'api:',
            'prefix' => 'api',
            'middleware' => ['web'],
        ], base_path('routes/api.php'));
    }

    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => ['web'],
        ], base_path('routes/web.php'));
    }
}
