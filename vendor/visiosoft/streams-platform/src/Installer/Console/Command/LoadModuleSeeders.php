<?php namespace Anomaly\Streams\Platform\Installer\Console\Command;

use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Installer\Installer;
use Anomaly\Streams\Platform\Installer\InstallerCollection;
use Anomaly\Streams\Platform\Console\Kernel;

/**
 * Class LoadModuleSeeders
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class LoadModuleSeeders
{

    /**
     * The installer collection.
     *
     * @var InstallerCollection
     */
    protected $installers;

    /**
     * Create a new LoadModuleSeeders instance.
     *
     * @param InstallerCollection $installers
     */
    public function __construct(InstallerCollection $installers)
    {
        $this->installers = $installers;
    }

    /**
     * Handle the command.
     *
     * @param ModuleCollection $modules
     */
    public function handle(ModuleCollection $modules)
    {
        /* @var Module $module */
        foreach ($modules as $module) {
            if ($module->getNamespace() == 'anomaly.module.installer') {
                continue;
            }

            $this->installers->push(
                new Installer(
                    trans('streams::installer.seeding', ['seeding' => trans($module->getName())]),
                    function (Kernel $console) use ($module) {
                        $console->call(
                            'db:seed',
                            [
                                '--addon' => $module->getNamespace(),
                                '--force' => true,
                            ]
                        );
                    }
                )
            );
        }
    }
}
