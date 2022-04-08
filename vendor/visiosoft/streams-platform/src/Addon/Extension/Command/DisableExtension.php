<?php namespace Anomaly\Streams\Platform\Addon\Extension\Command;

use Anomaly\Streams\Platform\Addon\Extension\Contract\ExtensionRepositoryInterface;
use Anomaly\Streams\Platform\Addon\Extension\Event\ExtensionWasDisabled;
use Anomaly\Streams\Platform\Addon\Extension\Extension;

/**
 * Class DisableExtension
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class DisableExtension
{

    /**
     * The extension to uninstall.
     *
     * @var Extension
     */
    protected $extension;

    /**
     * Create a new DisableExtension instance.
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
     * @param  ExtensionRepositoryInterface $extensions
     * @return bool
     */
    public function handle(ExtensionRepositoryInterface $extensions)
    {
        $extensions->disable($this->extension);

        event(new ExtensionWasDisabled($this->extension));

        return true;
    }
}
