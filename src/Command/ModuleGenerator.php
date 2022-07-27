<?php

namespace Holoo\ModuleGenerator\Command;

use Holoo\ModuleGenerator\lib as lib;
use Holoo\ModuleGenerator\Traits\TraitHelp;
use Illuminate\Console\Command;

class ModuleGenerator extends Command
{
    use TraitHelp;

    protected $signature='modules:generate
        {name : Class (singular) for example User}';

    protected $description='Generate modules operations With Repositoriy Design Pattern';


    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name=$this->argument('name');
        $this->checkModule($name);
        lib\MethodGenerator::migration($name);
        lib\MethodGenerator::controller($name);
        lib\MethodGenerator::model($name);
        lib\MethodGenerator::request($name);
        lib\MethodGenerator::route($name);
        lib\MethodGenerator::ResourceCollection($name);
        lib\RepositoryGenerator::repositoryInterface($name);
        lib\RepositoryGenerator::eloquentRepository($name);
        lib\ProviderGenerator::AppServiceProvider($name);
        lib\MiddlewareGenerator::middleware($name);
        lib\BaseGenerator::bases($name);
    }


}
