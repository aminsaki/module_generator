<?php

namespace Holoo\ModuleGenerator\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait TraitHelp
{
    /**
     * @param $type
     * @return false|string
     */
    protected function getStub($type)
    {
        return file_get_contents(__DIR__ . "/../stubs/$type.stub");
    }

    /**
     * @param $path
     */
    protected function getMakeDirectory($path)
    {
        File::makeDirectory($path, $mode=0777, true, true);
    }

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
     * @param $folder
     * @param $pathName
     * @param $controllerTemplate
     */
    protected function FilePutContents($folder, $pathName, $controllerTemplate)
    {
        if ( !file_exists($path=app_path($folder)) )
            $this->getMakeDirectory($path);

        file_put_contents(app_path($pathName), $controllerTemplate);
    }

    /**
     * delete  service provider in config/app.php
     * @param $name
     * @param $paths
     */
    protected function DeleteServiceProviders($name)
    {
        $filename=base_path('config/app.php'); // the file to change
        $nameClass=ucwords($name);

        $replace=" ";
        $search=str_replace("/", '\\', "/App/Modules/{$name}/Providers/{$nameClass}AppServiceProvider::class,");

        file_put_contents($filename, str_replace($search, $replace, file_get_contents($filename)));
    }

    /**
     * Register service provider in config/app.php
     * @param $name
     * @param $paths
     */
    protected function AddServiceProviders($name, $paths)
    {
        $filename=base_path() . '/config/app.php'; // the file to change
        $search='
        /*
        * Application Service Providers...
        */';

        $replace='
        /*
        * Application Service Providers...
        */' . PHP_EOL . str_replace("/", '\\', "/App/Modules/{$name}/{$paths}::class,");

        file_put_contents($filename, str_replace($search, $replace, file_get_contents($filename)));
    }

    /**
     * @param $name
     * @param $nameStub
     * @return false|string|string[]
     */
    protected function makeTemplate($name, $nameStub)
    {
        $nameClass=ucwords($name);
        $template=str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameBig}}',

            ],
            [
                $nameClass,
                $name,
                strtolower(Str::plural($name)),
            ],
            $this->getStub($nameStub)
        );
        return $template;
    }
}
