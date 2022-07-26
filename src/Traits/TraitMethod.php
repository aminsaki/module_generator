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
    protected function ResourceCollection($name)
    {
        $nameClass=ucwords($name);
        $this->FilePutContents("Modules/{$name}/Http/Resources",
            "Modules/{$name}/Http/Resources/{$nameClass}Resources.php", $this->makeTemplate($name, 'resource-collection'));
    }

}
