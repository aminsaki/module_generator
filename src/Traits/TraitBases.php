<?php


namespace Holoo\ModuleGenerator\Traits;


trait TraitBases
{

    /**
     * @param $name
     */
    protected function bases($name)
    {
        if ( !file_exists($path=app_path("Modules/bases")) ) {
            $this->BaseServiceProvider($name);
            $this->BaseRepositoryInterface($name);
            $this->BaseRepository($name);
        }
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
}
