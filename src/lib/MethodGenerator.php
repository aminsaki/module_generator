<?php

namespace Holoo\ModuleGenerator\lib;

use Illuminate\Support\Str;

use Holoo\ModuleGenerator\lib\AbstractGenerator;

class  MethodGenerator extends AbstractGenerator
{
    /**
     * @param string $name
     */
    public static function controller($name)
    {
        $nameClass=ucwords($name);
       self::FilePutContents("Modules/{$name}/Http/Controllers",
            "Modules/{$name}/Http/Controllers/{$nameClass}Controller.php", self::makeTemplate($name, 'Controller'));
    }

    /**
     * @param string $name
     */
    public static function request($name)
    {
       self::FilePutContents("Modules/{$name}/Http/Requests",
            "Modules/{$name}/Http/Requests/{$name}Request.php", self::makeTemplate($name, 'Request'));
    }

    /**
     * @param string $name
     */
    public static function route($name)
    {
       self::FilePutContents("Modules/{$name}/routes",
            "Modules/{$name}/routes/api.php", self::makeTemplate($name, 'routes'));
    }
    /**
     * @param string $name
     */
    public static function migration($name)
    {
        $tableName=date('Y_m_d_His') . '_' . 'create' . '_' . strtolower(Str::plural($name)) . '_' . 'table.php';

        self::FilePutContents(
            "Modules/{$name}/database/migrations/",
            "Modules/{$name}/database/migrations/" . $tableName, self::makeTemplate($name, 'Migration'));
    }

    /**
     * @param string $name
     */
    public static function model($name)
    {
        $nameClass=ucwords($name);
       self::FilePutContents("Modules/{$name}/Models",
            "Modules/{$name}/Models/{$nameClass}.php", self::makeTemplate($name, 'Model'));
    }
    /**
     * @param string $name
     */
    public static function ResourceCollection($name)
    {
        $nameClass=ucwords($name);
       self::FilePutContents("Modules/{$name}/Http/Resources",
            "Modules/{$name}/Http/Resources/{$nameClass}Resources.php", self::makeTemplate($name, 'resource-collection'));
    }
    /**
     * @param string $name
     */
    public static function config($name)
    {
       self::FilePutContents("Modules/{$name}/config",
        "Modules/{$name}/config/{$name}.php", self::makeTemplate($name, 'Config'));
    }


}
