<?php

namespace Holoo\ModuleGenerator\Command;

use Holoo\ModuleGenerator\Traits\TraitHelp;
use Holoo\ModuleGenerator\Traits\TraitMethod;
use Illuminate\Console\Command;

class ModuleGenerator extends Command
{
    use TraitHelp, TraitMethod;

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
        $this->providers($name);
        $this->ResourceCollection($name);
        $this->AppServiceProvider($name);
        $this->bases($name);

    }

    /**
     * @param  $name
     */
    protected function bases( $name)
    {
        if ( !file_exists($path=app_path("Modules/bases")) ) {
            $this->BaseServiceProvider($name);
            $this->BaseRepositoryInterface($name);
            $this->BaseRepository($name);
        }
    }


}
