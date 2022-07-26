<?php


namespace Holoo\ModuleGenerator\Traits;


trait TraitRepository
{

    /**
     * @param string $name
     */
    protected function eloquentRepository($name)
    {
        $this->FilePutContents("Modules/{$name}/Http/Repositories",
            "Modules/{$name}/Http/Repositories/Eloquent{$name}Repository.php", $this->makeTemplate($name, 'eloquentRepository'));
    }
    /**
     * @param string $name
     */
    protected function repositoryInterface($name)
    {
        $this->FilePutContents("Modules/{$name}/Http/Repositories",
            "Modules/{$name}/Http/Repositories/{$name}RepositoryInterface.php", $this->makeTemplate($name, 'RepositoryInterface'));
    }

}
