<?php namespace Anomaly\Streams\Platform\Installer\Console\Command;

use Anomaly\Streams\Platform\Installer\Installer;
use Anomaly\Streams\Platform\Installer\InstallerCollection;
use Illuminate\Console\Command;
use Illuminate\Contracts\Container\Container;

/**
 * Class RunInstallers
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RunInstallers
{

    /**
     * The console command.
     *
     * @var Command
     */
    protected $command;

    /**
     * The installer collection.
     *
     * @var InstallerCollection
     */
    protected $installers;

    /**
     * Create a new RunInstallers instance.
     *
     * @param InstallerCollection $installers
     * @param Command             $command
     */
    public function __construct(InstallerCollection $installers, Command $command = null)
    {
        $this->command    = $command;
        $this->installers = $installers;
    }

    /**
     * Handle the command.
     *
     * @param Container $container
     */
    public function handle(Container $container)
    {
        $step  = 1;
        $total = $this->installers->count();

        /* @var Installer $installer */
        while ($installer = $this->installers->shift()) {
            if ($this->command) {
                $this->command->info("{$step}/{$total} " . trans($installer->getMessage()));
            }

            $container->call($installer->getTask());

            $step++;
        }
    }
}
