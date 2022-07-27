<?php


namespace Holoo\ModuleGenerator\lib;


class ProviderGenerator extends  AbstractGenerator
{

    /**
     * @param string $name
     */
    public  static  function AppServiceProvider($name)
    {
        $nameClass=ucwords($name);
        self::FilePutContents("Modules/{$name}/Providers", "Modules/{$name}/Providers/{$nameClass}AppServiceProvider.php", self::makeTemplate($name, 'AppServiceProvider'));

        self::AddServiceProviders($name, "Providers/{$nameClass}AppServiceProvider");
    }
}












