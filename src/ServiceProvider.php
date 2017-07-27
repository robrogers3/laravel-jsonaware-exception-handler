<?php

namespace RobRogers3\LaravelExceptionHandler;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class ServiceProvider.
 *

 */

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var boolean
     */
    protected $defer = false;

    /**
     * The namespace of the loaded config files.
     *
     * @var string
     */
    public $namespace = 'robrogers3/laravel-error-handler';

    /**
     * Registers resources for the package.
     */
    public function boot()
    {
        $path = __DIR__ . '/../resources/lang/';

        $this->loadTranslationsFrom($path, $this->namespace);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }
}
