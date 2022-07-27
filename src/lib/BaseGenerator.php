<?php

namespace Holoo\ModuleGenerator\lib;

use Illuminate\Support\Str;

use Holoo\ModuleGenerator\lib\AbstractGenerator;

class  BaseGenerator extends AbstractGenerator
{

    /**
     * @param $name
     */
    public static  function   bases($name)
    {
        if ( !file_exists($path=app_path("Modules/bases")) ) {
           self::BaseServiceProvider($name);
           self::BaseRepositoryInterface($name);
           self::BaseRepository($name);
        }
    }
    /**
     * @param string $name
     */
    public static  function   BaseRepository($name)
    {
       self::FilePutContents("Modules/bases", "Modules/bases/BaseRepository.php",self::makeTemplate($name, 'BaseRepository'));
    }
    /**
     * @param string $name
     */
    public static  function   BaseServiceProvider($name)
    {
       self::FilePutContents("Modules/bases",
            "Modules/bases/BaseServiceProvider.php",self::makeTemplate($name, 'BaseServiceProvider'));
       self::AddServiceProviders('bases', 'BaseServiceProvider');
    }
    /**
     * @param string $name
     */
    public static  function   BaseRepositoryInterface($name)
    {
       self::FilePutContents("Modules/bases",
            "Modules/bases/BaseRepositoryInterface.php",self::makeTemplate($name, 'BaseRepositoryInterface'));
    }
}
