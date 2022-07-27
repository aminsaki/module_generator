<?php


namespace Holoo\ModuleGenerator\Facades;


use Illuminate\Support\Facades\Facade;

class BaseFacade extends  Facade
{

    protected static function getFacadeAccessor()
    {
        return 'base';
    }
}
