<?php


namespace Holoo\ModuleGenerator\Facades;


use Illuminate\Support\Facades\Facade;

class MiddlewareFacades extends  Facade
{

    protected static function getFacadeAccessor()
    {
        return 'middleware';
    }

}
