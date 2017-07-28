<?php

namespace Tests;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../vendor/laravel/laravel/bootstrap/app.php';
        
        $app->register('RobRogers3\LaravelExceptionHandler\ServiceProvider');

        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        $this->publishResources();
        
        return $app;  
        
    }

    public function publishResources()
    {
        $fileSystem = new Filesystem;

        $dir = resource_path('lang') . "/vendor/robrogers3/laravel-jsonaware-exception-handler/en/";
        if (!$fileSystem->exists($dir)) {
            $fileSystem->makeDirectory($dir, 493, true);
        }

        $rv = $fileSystem->copy(__DIR__ . '/../resources/lang/en/exceptionmessages.php', "$dir/exceptionmessages.php");
    }
}
