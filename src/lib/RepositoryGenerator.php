<?php


namespace Holoo\ModuleGenerator\lib;


class RepositoryGenerator extends  AbstractGenerator
{

    /**
     * @param string $name
     */
    public  static function eloquentRepository($name)
    {
        self::FilePutContents("Modules/{$name}/Http/Repositories",
            "Modules/{$name}/Http/Repositories/Eloquent{$name}Repository.php", self::makeTemplate($name, 'eloquentRepository'));
    }
    /**
     * @param string $name
     */
    public  static function repositoryInterface($name)
    {
         self::FilePutContents("Modules/{$name}/Http/Repositories",
            "Modules/{$name}/Http/Repositories/{$name}RepositoryInterface.php", self::makeTemplate($name, 'RepositoryInterface'));
    }

}
