<?php
namespace Holoo\ModuleGenerator\Traits;

use Illuminate\Support\Facades\File;

trait TraitHelp{


    /**
     * @param $name
     */
    protected function checkModule($name)
    {
        if ( file_exists($path=app_path("Modules/{$name}")) ) {
            exit("This name already exists");
        }
    }

    /**
     * @param $name
     */
    protected function fileDelete($name)
    {
        if ( !file_exists($path=app_path("Modules/{$name}")) )
             exit("This module does not exist");

        if ( file_exists($path=app_path("Modules/{$name}")) === "bases" )
             exit("It is not possible to delete this module");

        File::deleteDirectory("app/Modules/{$name}");

        $this->DeleteServiceProviders($name);

    }
    /**
     * delete  service provider in config/app.php
     * @param $name
     * @param $paths
     */
    public function DeleteServiceProviders($name)
    {
        $filename=base_path('config/app.php'); // the file to change
        $nameClass=ucwords($name);

        $replace=" ";
        $search=str_replace("/", '\\', "/App/Modules/{$name}/Providers/{$nameClass}AppServiceProvider::class,");

        file_put_contents($filename, str_replace($search, $replace, file_get_contents($filename)));
    }
}
