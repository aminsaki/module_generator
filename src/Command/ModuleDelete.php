<?php

namespace Holoo\ModuleGenerator\Command;

use Holoo\ModuleGenerator\Traits\TraitHelp;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ModuleDelete extends Command
{
    use TraitHelp;

    protected $signature='modules:delete
        {name : Class (singular) for example User}';

    protected $description='Delete module  ';


    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name=$this->argument('name');

        $this->fileDelete($name);
    }

    /**
     * @param $name
     */
    protected function fileDelete($name)
    {
        if(!file_exists($path=app_path("Modules/{$name}")))
            exit("This module does not exist");

      if(file_exists($path=app_path("Modules/{$name}")) == "bases")
             exit("It is not possible to delete this module");

        File::deleteDirectory("app/Modules/{$name}");
        $this->DeleteServiceProviders($name);

    }


}
