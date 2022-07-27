<?php


namespace Holoo\ModuleGenerator\Facades;


use Illuminate\Support\Facades\Facade;

class MethodGeneratorFacade extends  Facade
{

    protected static function getFacadeAccessor()
    {
        return 'methodgenerator';
    }
}
