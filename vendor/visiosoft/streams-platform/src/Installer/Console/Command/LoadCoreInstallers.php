<?php namespace Anomaly\Streams\Platform\Installer\Console\Command;

use Anomaly\Streams\Platform\Installer\Installer;
use Anomaly\Streams\Platform\Installer\InstallerCollection;
use Anomaly\Streams\Platform\Console\Kernel;

/**
 * Class LoadCoreInstallers
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class LoadCoreInstallers
{

    /**
     * The installer collection.
     *
     * @var InstallerCollection
     */
    protected $installers;

    /**
     * Create a new LoadCoreInstallers instance.
     *
     * @param InstallerCollection $installers
     */
    public function __construct(InstallerCollection $installers)
    {
        $this->installers = $installers;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        $this->installers->push(
            new Installer(
                'streams::installer.running_core_migrations',
                function (Kernel $console) {
                    $console->call(
                        'migrate',
                        [
                            '--force' => true,
                            '--path'  => 'vendor/visiosoft/streams-platform/migrations/core',
                        ]
                    );
                }
            )
        );
    }
}
