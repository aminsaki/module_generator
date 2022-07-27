<?php

namespace Holoo\ModuleGenerator\lib;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MiddlewareGenerator extends  AbstractGenerator
{
    /**
     * @param string $name
     */
    public static function middleware($name)
    {
        $nameClass=ucwords($name);
        self::FilePutContents("Modules/{$name}/Http/Middleware",
            "Modules/{$name}/Http/Middleware/{$nameClass}Middleware.php", self::makeTemplate($name, 'middleware'));
         self::AddMiddleware($name);
    }

}
