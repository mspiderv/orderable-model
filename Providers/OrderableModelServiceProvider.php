<?php

namespace Vitlabs\OrderableModel\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class OrderableModelServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    protected $namespace = 'Vitlabs\OrderableModel\Controllers';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require __DIR__ . '/../routes.php';
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
