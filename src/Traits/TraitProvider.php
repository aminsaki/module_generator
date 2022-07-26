<?php


namespace Holoo\ModuleGenerator\Traits;


trait TraitProvider
{
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
