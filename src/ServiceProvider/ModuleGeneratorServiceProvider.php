<?php

namespace Holoo\ModuleGenerator\ServiceProvider;

use Holoo\ModuleGenerator\Command as command;
use Holoo\ModuleGenerator\lib as lib;
use Illuminate\Support\ServiceProvider;

class ModuleGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('methodgenerator', lib\MethodGenerator::class);
        $this->app->bind('repositorygenerator', lib\RepositoryGenerator::class);
        $this->app->bind('providergenerator', lib\ProviderGenerator::class);
        $this->app->bind('middleware', lib\MiddlewareGenerator::class);
        $this->app->bind('base', lib\BaseGenerator::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ( app()->runningInConsole() ) {
            $this->commands([
                command\ModuleDelete::class,
                command\ModuleGenerator::class
            ]);
        }
    }

}
