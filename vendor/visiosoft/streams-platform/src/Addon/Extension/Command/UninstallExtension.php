<?php namespace Anomaly\Streams\Platform\Addon\Extension\Command;

use Anomaly\Streams\Platform\Addon\Extension\Contract\ExtensionRepositoryInterface;
use Anomaly\Streams\Platform\Addon\Extension\Event\ExtensionWasUninstalled;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Console\Kernel;

/**
 * Class UninstallExtension
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class UninstallExtension
{

    /**
     * The extension to uninstall.
     *
     * @var Extension
     */
    protected $extension;

    /**
     * Create a new UninstallExtension instance.
     *
     * @param Extension $extension
     */
    public function __construct(Extension $extension)
    {
        $this->extension = $extension;
    }

    /**
     * Handle the command.
     *
     * @param  Kernel $console
     * @param  ExtensionRepositoryInterface $extensions
     * @return bool
     */
    public function handle(Kernel $console, ExtensionRepositoryInterface $extensions)
    {
        $this->extension->fire('uninstalling', ['extension' => $this->extension]);

        $options = [
            '--addon' => $this->extension->getNamespace(),
        ];

        $console->call('migrate:reset', $options);
        $console->call('streams:destroy', ['namespace' => $this->extension->getSlug()]);
        $console->call('streams:cleanup');

        $extensions->uninstall($this->extension);

        $this->extension->fire('uninstalled', ['extension' => $this->extension]);

        event(new ExtensionWasUninstalled($this->extension));

        return true;
    }
}
