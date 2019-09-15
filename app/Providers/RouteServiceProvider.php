<?php

namespace App\Providers;

use Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';

    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    protected function mapWebRoutes()
    {
        Route::group([
            'namespace' => $this->namespace,
            'middleware' => ['web'],
        ], base_path('routes/web.php'));
    }

    protected function mapApiRoutes()
    {
        Route::group([
            'as' => 'api:',
            'prefix' => 'api',
            'namespace' => $this->namespace . '\Api',
            'middleware' => ['web'],
        ], base_path('routes/web.api.php'));
    }
}
