<?php

namespace Holoo\ModuleGenerator\lib;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

abstract class AbstractGenerator
{
    /**
     * @param $type
     * @return false|string
     */
    public static function getStub($type)
    {
        return file_get_contents(__DIR__ . "/../stubs/$type.stub");
    }

    /**
     * @param $path
     */
    public static function getMakeDirectory($path)
    {
        File::makeDirectory($path, $mode=0777, true, true);
    }

    /**
     * @param $folder
     * @param $pathName
     * @param $controllerTemplate
     */
    public static function FilePutContents($folder, $pathName, $controllerTemplate)
    {

        if ( !file_exists($path=app_path($folder)) )
            self::getMakeDirectory($path);

        file_put_contents(app_path($pathName), $controllerTemplate);
    }



    /**
     * Register service provider in config/app.php
     * @param $name
     * @param $paths
     */
    public function AddServiceProviders($name, $paths)
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
    public static function makeTemplate($name, $nameStub)
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
            self::getStub($nameStub)
        );
        return $template;
    }

    public static function AddMiddleware($name)
    {
        $nameClass=ucwords($name);
        $filename=base_path('app/http/Kernel.php'); // the file to change

        $search="\App\Http\Middleware\Authenticate::class,";

        $replace="\App\Http\Middleware\Authenticate::class," . PHP_EOL .
            "'{$name}'=>" . str_replace("/", '\\', "/App/Modules/{$name}/Http/Middleware/{$nameClass}::class,");

        file_put_contents($filename, str_replace($search, $replace, file_get_contents($filename)));

    }
}
