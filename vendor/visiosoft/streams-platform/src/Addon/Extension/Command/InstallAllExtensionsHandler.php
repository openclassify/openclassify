<?php namespace Anomaly\Streams\Platform\Addon\Extension\Command;

use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionManager;

/**
 * Class InstallAllExtensionsHandler
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class InstallAllExtensionsHandler
{

    /**
     * The extension manager.
     *
     * @var ExtensionManager
     */
    protected $manager;

    /**
     * The loaded extensions.
     *
     * @var ExtensionCollection
     */
    protected $extensions;

    /**
     * Create a new InstallAllExtensionsHandler instance.
     *
     * @param ExtensionCollection $extensions
     * @param ExtensionManager    $service
     */
    public function __construct(ExtensionCollection $extensions, ExtensionManager $service)
    {
        $this->manager    = $service;
        $this->extensions = $extensions;
    }

    /**
     * Handle the command.
     *
     * @param InstallAllExtensions $command
     */
    public function handle(InstallAllExtensions $command)
    {
        foreach ($this->extensions->all() as $extension) {
            $this->manager->install($extension, $command->getSeed());
        }
    }
}
