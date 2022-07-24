<?php

namespace Holoo\ModuleGenerator\Command;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

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
        $this->providers($name);
        $this->AppServiceProvider($name);
        if ( !file_exists($path=app_path("Modules/bases")) ) {
            $this->BaseServiceProvider($name);
            $this->BaseRepositoryInterface($name);
            $this->BaseRepository($name);
        }
    }


    /**
     * @param $name
     */
    protected function migration($name)
    {
        $nameClass=ucwords($name);
        $migrationTemplate=str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
            ],
            [
                $nameClass,
                strtolower(Str::plural($name)),
            ],
            $this->getStub('Migration')
        );
        $tableName=date('Y_m_d_His') . '_' . 'create' . '_' . strtolower(Str::plural($name)) . '_' . 'table.php';

        $this->FilePutContents(
            "Modules/{$name}/database/migrations/",
            "Modules/{$name}/database/migrations/" . $tableName, $migrationTemplate);
    }

    /**
     * @param $name
     */
    protected function controller($name)
    {
        $nameClass=ucwords($name);
        $controllerTemplate=str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $nameClass,
                $name,
                strtolower($name)
            ],
            $this->getStub('Controller')
        );
        $this->FilePutContents("Modules/{$name}/Http/Controllers",
            "Modules/{$name}/Http/Controllers/{$nameClass}Controller.php", $controllerTemplate);
    }

    /**
     * @param $name
     */
    protected function model($name)
    {
        $nameClass=ucwords($name);
        $modelTemplate=str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',

            ],
            [
                $nameClass,
                $name
            ],
            $this->getStub('Model')

        );
        $this->FilePutContents("Modules/{$name}/Models",
            "Modules/{$name}/Models/{$nameClass}.php", $modelTemplate);
    }

    /**
     * @param $name
     */
    protected function repositoryInterface($name)
    {
        $nameClass=ucwords($name);
        $repositoryInterfaceTemplate=str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
            ],
            [
                $nameClass,
                $name
            ],
            $this->getStub('RepositoryInterface')
        );

        $this->FilePutContents("Modules/{$name}/Http/Repositories",
            "Modules/{$name}/Http/Repositories/{$name}RepositoryInterface.php", $repositoryInterfaceTemplate);
    }

    /**
     * @param $name
     */
    protected function eloquentRepository($name)
    {
        $nameClass=ucwords($name);

        $eloquentRepositoryTemplate=str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
            ],
            [
                $nameClass,
                $name
            ],
            $this->getStub('eloquentRepository')
        );
        $this->FilePutContents("Modules/{$name}/Http/Repositories",
            "Modules/{$name}/Http/Repositories/Eloquent{$name}Repository.php", $eloquentRepositoryTemplate);
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
        $this->FilePutContents("Modules/{$name}/Http/Requests",
            "Modules/{$name}/Http/Requests/{$name}Request.php", $requestTemplate);
    }

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
    protected function route($name)
    {
        $nameClass=ucwords($name);
        $routeTemplate=str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
            ],
            [
                $nameClass,
                $name
            ],
            $this->getStub('routes')
        );

        $this->FilePutContents("Modules/{$name}/routes",
            "Modules/{$name}/routes/api.php", $routeTemplate);


    }

    /**
     * @param $name
     */
    protected function AppServiceProvider($name)
    {
        $nameClass=ucwords($name);

        $ProviderTemplate=str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
            ],
            [
                $nameClass,
                $name
            ],
            $this->getStub('AppServiceProvider')
        );

        $this->FilePutContents("Modules/{$name}/Providers", "Modules/{$name}/Providers/{$nameClass}AppServiceProvider.php", $ProviderTemplate);

        $this->AddServiceProviders($name, "Providers/{$nameClass}AppServiceProvider");
    }


    /**
     * @param $name
     */
    protected function providers($name)
    {

        $nameClass=ucwords($name);

        $ProviderTemplate=str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
            ],
            [
                $nameClass,
                $name
            ],
            $this->getStub('Providers')
        );

        $this->FilePutContents("Modules/{$name}/Providers",
            "Modules/{$name}/Providers/{$nameClass}RouteServiceProvider.php", $ProviderTemplate);

        $this->AddServiceProviders($name, "Providers/{$nameClass}RouteServiceProvider");

    }

    protected function BaseRepository($name)
    {

        $BaseRepository=str_replace(
            [
                '{{modelName}}',
            ],
            [
                $name
            ],
            $this->getStub('BaseRepository')
        );
        $this->FilePutContents("Modules/bases", "Modules/bases/BaseRepository.php", $BaseRepository);

    }

    protected function BaseServiceProvider($name)
    {

        $BaseServiceTemplate=str_replace(
            [
                '{{modelName}}',
            ],
            [
                $name
            ],
            $this->getStub('BaseServiceProvider')
        );
        $this->FilePutContents("Modules/bases",
            "Modules/bases/BaseServiceProvider.php", $BaseServiceTemplate);


        $this->AddServiceProviders('bases', 'BaseServiceProvider');

    }

    protected function BaseRepositoryInterface($name)
    {

        $BaseRepositoryInterface=str_replace(
            [
                '{{modelName}}',
            ],
            [
                $name
            ],
            $this->getStub('BaseRepositoryInterface')
        );
        $this->FilePutContents("Modules/bases",
            "Modules/bases/BaseRepositoryInterface.php", $BaseRepositoryInterface);

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
}
