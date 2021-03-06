<?php

namespace RobRogers3\LaravelExceptionHandler;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

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
    public $namespace = 'robrogers3/laravel-jsonaware-exception-handler';

    /**
     * Registers resources for the package.
     */
    public function boot()
    {
        $path = __DIR__ . '/../resources/lang/en/exceptionmessages.php';

        $this->publishes([
            $path => resource_path("lang/vendor/{$this->namespace}/en/exceptionmessages.php"),
        ]);

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
        if (env('USE_JSON_EXCEPTION_HANDLER', false)) {
            $this->app->bind(
                \Illuminate\Contracts\Debug\ExceptionHandler::class,
                'RobRogers3\LaravelExceptionHandler\JsonAwareExceptionHandler'
            );
        }
        
    }
}
