<?php namespace Anomaly\Streams\Platform\Addon\Module\Command;

use Anomaly\Streams\Platform\Addon\AddonManager;
use Anomaly\Streams\Platform\Addon\Module\Contract\ModuleRepositoryInterface;
use Anomaly\Streams\Platform\Addon\Module\Event\ModuleWasInstalled;
use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Console\Kernel;
use Anomaly\Streams\Platform\Entry\Command\AutoloadEntryModels;

/**
 * Class InstallModule
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class InstallModule
{

    /**
     * The seed flag.
     *
     * @var bool
     */
    protected $seed;

    /**
     * The module to install.
     *
     * @var Module
     */
    protected $module;

    /**
     * Create a new InstallModule instance.
     *
     * @param Module $module
     * @param bool $seed
     */
    public function __construct(Module $module, $seed = false)
    {
        $this->seed   = $seed;
        $this->module = $module;
    }

    /**
     * Handle the command.
     *
     * @param  Kernel $console
     * @param  AddonManager $manager
     * @param  ModuleRepositoryInterface $modules
     * @return bool
     */
    public function handle(
        Kernel $console,
        AddonManager $manager,
        ModuleRepositoryInterface $modules
    ) {
        $this->module->fire('installing', ['module' => $this->module]);

        $options = [
            '--addon' => $this->module->getNamespace(),
            '--force' => true,
        ];

        $console->call('migrate', $options);

        dispatch_now(new AutoloadEntryModels);
        
        $modules->install($this->module);

        $manager->register();

        if ($this->seed) {
            $console->call('db:seed', $options);
        }

        $this->module->fire('installed', ['module' => $this->module]);

        event(new ModuleWasInstalled($this->module));

        return true;
    }
}
