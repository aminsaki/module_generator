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
        $this->SetClassFaced();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->SetCommand();
    }

    /**
     *   This method is for faced list
     */
    protected function SetClassFaced()
    {
        $this->app->singleton('methodgenerator', lib\MethodGenerator::class);
        $this->app->singleton('repositorygenerator', lib\RepositoryGenerator::class);
        $this->app->singleton('providergenerator', lib\ProviderGenerator::class);
        $this->app->singleton('middleware', lib\MiddlewareGenerator::class);
        $this->app->singleton('base', lib\BaseGenerator::class);
    }
    /**
     *   This method is for Command list
     */
    protected function SetCommand()
    {
        if ( app()->runningInConsole() ) $this->commands([
            command\ModuleDelete::class,
            command\ModuleGenerator::class
        ]);
    }

}
