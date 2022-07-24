<?php

namespace Holoo\ModuleGenerator\ServiceProvider;

use Holoo\ModuleGenerator\Command\BaseRepositories;
use Holoo\ModuleGenerator\Command\CrudGenerator;
use Illuminate\Support\ServiceProvider;

class ModuleGeneratorServiceProvider extends  ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(app()->runningInConsole()) {
            $this->commands([
                CrudGenerator::class,
            ]);
        }
    }


}
