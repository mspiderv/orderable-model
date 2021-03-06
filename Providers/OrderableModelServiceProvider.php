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
        // Load Translation Files
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang/', 'orderable-model');

        // Register Routes
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
        // Publish configuration file
        $this->publishes([
            __DIR__ . '/../Config/orderable-models.php' => config_path('orderable-models.php'),
        ], 'config');

        // Merge configuration file
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/orderable-models.php', 'orderable-models'
        );
    }
}
