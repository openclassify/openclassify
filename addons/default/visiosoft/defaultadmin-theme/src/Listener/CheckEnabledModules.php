<?php namespace Visiosoft\DefaultadminTheme\Listener;

use Anomaly\SettingsModule\Setting\Form\SettingFormBuilder;
use Anomaly\Streams\Platform\Addon\Module\Command\InstallModule;
use Anomaly\Streams\Platform\Addon\Module\Command\UninstallModule;
use Anomaly\Streams\Platform\Addon\Module\Contract\ModuleRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Form\Event\FormWasSaved;
use Illuminate\Foundation\Bus\DispatchesJobs;

class CheckEnabledModules
{
    use DispatchesJobs;

    private $moduleRepository;

    public function __construct(ModuleRepositoryInterface $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    public function handle(FormWasSaved $event)
    {
        $builder = $event->getBuilder();

        if (get_class($builder) == SettingFormBuilder::class) {
            $value = $builder->getFormFields()->where('field', 'enabled_modules')->first()->getValue();
            $disabledModules = app('module.collection')->whereNotIn('namespace', $value);
            $enabledModules = app('module.collection')->whereIn('namespace', $value);
            foreach ($disabledModules as $module) {
                if ($module->isInstalled()) {
                    $this->dispatchNow(new UninstallModule($module, true));
                }
            }
            foreach ($enabledModules as $module) {
                if (!$module->isInstalled()) {
                    $this->dispatchNow(new InstallModule($module, true));
                }
            }
        }
    }
}
