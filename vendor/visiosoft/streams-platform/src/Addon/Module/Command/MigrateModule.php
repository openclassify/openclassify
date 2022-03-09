<?php namespace Anomaly\Streams\Platform\Addon\Module\Command;

use Anomaly\Streams\Platform\Addon\AddonManager;
use Anomaly\Streams\Platform\Addon\Module\Event\ModuleWasMigrated;
use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Console\Kernel;

/**
 * Class MigrateModule
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class MigrateModule
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
     * @return bool
     */
    public function handle(Kernel $console, AddonManager $manager)
    {
        $this->module->fire('migrating', ['module' => $this->module]);

        $options = [
            '--addon' => $this->module->getNamespace(),
            '--force' => true,
        ];

        $console->call('migrate', $options);

        $manager->register();

        if ($this->seed) {
            $console->call('db:seed', $options);
        }

        $this->module->fire('migrated', ['module' => $this->module]);

        event(new ModuleWasMigrated($this->module));

        return true;
    }
}
