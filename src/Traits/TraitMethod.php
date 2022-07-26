<?php

namespace Holoo\ModuleGenerator\Traits;

use Illuminate\Support\Str;

trait  TraitMethod
{
    /**
     * @param string $name
     */
    protected function controller($name)
    {
        $nameClass=ucwords($name);
        $this->FilePutContents("Modules/{$name}/Http/Controllers",
            "Modules/{$name}/Http/Controllers/{$nameClass}Controller.php", $this->makeTemplate($name, 'Controller'));
    }

    /**
     * @param string $name
     */
    protected function request($name)
    {
        $this->FilePutContents("Modules/{$name}/Http/Requests",
            "Modules/{$name}/Http/Requests/{$name}Request.php", $this->makeTemplate($name, 'Request'));
    }

    /**
     * @param string $name
     */
    protected function route($name)
    {
        $this->FilePutContents("Modules/{$name}/routes",
            "Modules/{$name}/routes/api.php", $this->makeTemplate($name, 'routes'));
    }

    /**
     * @param string $name
     */
    protected function BaseRepository($name)
    {
        $this->FilePutContents("Modules/bases", "Modules/bases/BaseRepository.php", $this->makeTemplate($name, 'BaseRepository'));
    }

    /**
     * @param string $name
     */
    protected function BaseServiceProvider($name)
    {
        $this->FilePutContents("Modules/bases",
            "Modules/bases/BaseServiceProvider.php", $this->makeTemplate($name, 'BaseServiceProvider'));
        $this->AddServiceProviders('bases', 'BaseServiceProvider');
    }

    /**
     * @param string $name
     */
    protected function BaseRepositoryInterface($name)
    {
        $this->FilePutContents("Modules/bases",
            "Modules/bases/BaseRepositoryInterface.php", $this->makeTemplate($name, 'BaseRepositoryInterface'));
    }

    /**
     * @param string $name
     */
    protected function migration($name)
    {
        $tableName=date('Y_m_d_His') . '_' . 'create' . '_' . strtolower(Str::plural($name)) . '_' . 'table.php';

        $this->FilePutContents(
            "Modules/{$name}/database/migrations/",
            "Modules/{$name}/database/migrations/" . $tableName, $this->makeTemplate($name, 'Migration'));
    }

    /**
     * @param string $name
     */
    protected function model($name)
    {
        $nameClass=ucwords($name);
        $this->FilePutContents("Modules/{$name}/Models",
            "Modules/{$name}/Models/{$nameClass}.php", $this->makeTemplate($name, 'Model'));
    }

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
    protected function providers($name)
    {
        $nameClass=ucwords($name);

        $this->FilePutContents("Modules/{$name}/Providers",
            "Modules/{$name}/Providers/{$nameClass}RouteServiceProvider.php", $this->makeTemplate($name, 'Providers'));

        $this->AddServiceProviders($name, "Providers/{$nameClass}RouteServiceProvider");
    }

    /**
     * @param string $name
     */
    protected function repositoryInterface($name)
    {
        $this->FilePutContents("Modules/{$name}/Http/Repositories",
            "Modules/{$name}/Http/Repositories/{$name}RepositoryInterface.php", $this->makeTemplate($name, 'RepositoryInterface'));
    }

    /**
     * @param string $name
     */
    protected function ResourceCollection($name)
    {
        $nameClass=ucwords($name);
        $this->FilePutContents("Modules/{$name}/Http/Resources",
            "Modules/{$name}/Http/Resources/{$nameClass}Resources.php", $this->makeTemplate($name, 'resource-collection'));
    }

    /**
     * @param string $name
     */
    protected function AppServiceProvider($name)
    {
        $nameClass=ucwords($name);
        $this->FilePutContents("Modules/{$name}/Providers", "Modules/{$name}/Providers/{$nameClass}AppServiceProvider.php", $this->makeTemplate($name, 'AppServiceProvider'));
        $this->AddServiceProviders($name, "Providers/{$nameClass}AppServiceProvider");
    }
}
