<?php

namespace Holoo\ModuleGenerator\Command;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\String_;

class CrudGenerator extends Command
{
    protected $signature='crud:generate
        {name : Class (singular) for example User}';

    protected $description='Generate CRUD operations With Repositoriy Design Pattern';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name=$this->argument('name');
        $this->checkModule($name);
        $this->migration($name);
        $this->controller($name);
        $this->model($name);
        $this->repositoryInterface($name);
        $this->eloquentRepository($name);
        $this->request($name);
        $this->route($name);
    }

    /**
     * @param $name
     */
    protected function migration($name)
    {
        $migrationTemplate=str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
            ],
            [
                $name,
                strtolower(Str::plural($name)),
            ],
            $this->getStub('Migration')
        );
        $tableName=date('Y_m_d_His') . '_' . 'create' . '_' . strtolower(Str::plural($name)) . '_' . 'table.php';

        if ( !file_exists($path=app_path("Modules/{$name}/database/migrations/")) )
            $this->getMakeDirectory($path);

        file_put_contents(app_path("Modules/{$name}/database/migrations/") . $tableName, $migrationTemplate);

    }

    /**
     * @param $name
     */
    protected function controller($name)
    {
        $controllerTemplate=str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                strtolower(Str::plural($name)),
                strtolower($name)
            ],
            $this->getStub('Controller')
        );
        if ( !file_exists($path=app_path("Modules/{$name}/Http/Controllers")) )
            $this->getMakeDirectory($path);

        file_put_contents(app_path("Modules/{$name}/Http/Controllers/{$name}Controller.php"), $controllerTemplate);
    }

    /**
     * @param $name
     */
    protected function model($name)
    {
        $modelTemplate=str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Model')
        );
        if ( !file_exists($path=app_path("Modules/{$name}/Models")) )
            $this->getMakeDirectory($path);

        file_put_contents(app_path("Modules/{$name}/Models/{$name}.php"), $modelTemplate);
    }

    /**
     * @param $name
     */
    protected function repositoryInterface($name)
    {
        $repositoryInterfaceTemplate=str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('RepositoryInterface')
        );

        if ( !file_exists($path=app_path("Modules/{$name}/Http/Repositories/$name")) )
            $this->getMakeDirectory($path);

        file_put_contents(app_path("Modules/{$name}/Http/Repositories/$name/{$name}RepositoryInterface.php"), $repositoryInterfaceTemplate);
    }

    /**
     * @param $name
     */
    protected function eloquentRepository($name)
    {
        $eloquentRepositoryTemplate=str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('eloquentRepository')
        );
        if ( !file_exists($path=app_path("Modules/{$name}/Http/Repositories/$name")) )
            $this->getMakeDirectory($path);

        file_put_contents(app_path("Modules/{$name}/Http/Repositories/$name/eloquent{$name}Repository.php"), $eloquentRepositoryTemplate);
    }

    /**
     * @param $name
     */
    protected function request($name)
    {
        $requestTemplate=str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Request')
        );

        if ( !file_exists($path=app_path("Modules/{$name}/Http/Requests")) )
            $this->getMakeDirectory($path);

        file_put_contents(app_path("Modules/{$name}/Http/Requests/{$name}Request.php"), $requestTemplate);
    }

    /**
     * @param $type
     * @return false|string
     */
    protected function getStub($type)
    {
        return file_get_contents(base_path("stubs/$type.stub"));
    }

    /**
     * @param $path
     */
    protected function getMakeDirectory($path)
    {
        File::makeDirectory($path, $mode=0777, true, true);
    }

    /**
     * @param String $name
     */
    protected function route($name)
    {
        if ( !file_exists($path=base_path("Modules/{$name}/routes")) )
            $this->getMakeDirectory($path);

        File::append(base_path("Modules/{$name}/routes/api.php"), 'Route::resource(\'' . Str::plural(strtolower($name)) . "', '{$name}Controller');");
    }

    /**
     * @param $name
     * @return bool
     * @throws \Exception
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
}
