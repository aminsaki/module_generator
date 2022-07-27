<?php


namespace Holoo\ModuleGenerator\Facades;


use Illuminate\Support\Facades\Facade;

class ProviderGeneratorFacade extends  Facade
{

    protected static function getFacadeAccessor()
    {
        return 'providergenerator';
    }
}
