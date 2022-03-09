<?php namespace Visiosoft\AdvsModule\Support\Command;

use Anomaly\Streams\Platform\Addon\Module\Contract\ModuleRepositoryInterface;

class CheckModuleInstalled
{
    protected $moduleNamespace;
    protected $checkEnabled;

    public function __construct($moduleNamespace, $checkEnabled = true)
    {
        $this->moduleNamespace = $moduleNamespace;
        $this->checkEnabled = $checkEnabled;
    }

    public function handle(ModuleRepositoryInterface $moduleRepository)
    {
        if ($module = $moduleRepository->findBy('namespace', $this->moduleNamespace)) {
            return $this->checkEnabled ? $module->installed && $module->enabled : boolval($module->installed);
        }
        return false;
    }
}
