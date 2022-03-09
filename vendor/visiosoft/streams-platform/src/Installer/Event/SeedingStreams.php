<?php namespace Anomaly\Streams\Platform\Installer\Event;

use Anomaly\Streams\Platform\Installer\Console\InstallStreams;
use Anomaly\Streams\Platform\Installer\InstallerCollection;

/**
 * Class SeedingStreams
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SeedingStreams
{

    /**
     * The install command.
     *
     * @var InstallStreams
     */
    protected $command;

    /**
     * The installer collection.
     *
     * @var InstallerCollection
     */
    protected $installers;

    /**
     * Create a new SeedingStreams instance.
     *
     * @param InstallStreams      $command
     * @param InstallerCollection $installers
     */
    public function __construct(InstallStreams $command, InstallerCollection $installers)
    {
        $this->command    = $command;
        $this->installers = $installers;
    }

    /**
     * Get the command.
     *
     * @return InstallStreams
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * Get the installers.
     *
     * @return InstallerCollection
     */
    public function getInstallers()
    {
        return $this->installers;
    }
}
