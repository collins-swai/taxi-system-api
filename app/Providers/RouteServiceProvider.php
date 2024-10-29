<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This is the path where your routes are defined.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        // Optional: Define any route model bindings or other boot operations here
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        // Optionally define web routes if needed
        // $this->mapWebRoutes();
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless and are used for API endpoints.
     *
     * @return void
     */
    protected function mapApiRoutes()
{
    Route::prefix('api') // Ensure the prefix is set
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/api.php'));
}

    // Optional: Method for web routes
    // protected function mapWebRoutes()
    // {
    //     Route::middleware('web')
    //         ->namespace($this->namespace)
    //         ->group(base_path('routes/web.php'));
    // }
}
