<?php

namespace Holoo\ModuleGenerator\Command;

use Holoo\ModuleGenerator\Traits\TraitHelp;
use Holoo\ModuleGenerator\Traits\TraitMethod;
use Holoo\ModuleGenerator\Traits\TraitProvider;
use Holoo\ModuleGenerator\Traits\TraitRepository;
use Holoo\ModuleGenerator\Traits\TraitBases;
use Illuminate\Console\Command;

class ModuleGenerator extends Command
{
    use TraitHelp, TraitMethod, TraitBases, TraitRepository, TraitProvider;

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
        $this->migration($name);
        $this->controller($name);
        $this->model($name);
        $this->repositoryInterface($name);
        $this->eloquentRepository($name);
        $this->request($name);
        $this->route($name);
        $this->ResourceCollection($name);
        $this->AppServiceProvider($name);
        $this->bases($name);
    }


}
