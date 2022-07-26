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
    protected  function  fileDelete($name){
        $path=app_path("Modules/{$name}");
//      if(!file_exists($path) )
//         exit("not file");

//        File::deleteDirectory("app/Modules/{$name}");
        $this->DeleteServiceProviders($name);

    }



}
