<?php


namespace Holoo\ModuleGenerator\Facades;


use Illuminate\Support\Facades\Facade;

class RepositoryGeneratorFacades extends  Facade
{

    protected static function getFacadeAccessor()
    {
        return 'repositorygenerator';
    }
}
