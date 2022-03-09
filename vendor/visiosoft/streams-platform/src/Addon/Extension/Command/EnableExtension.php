<?php namespace Anomaly\Streams\Platform\Addon\Extension\Command;

use Anomaly\Streams\Platform\Addon\Extension\Contract\ExtensionRepositoryInterface;
use Anomaly\Streams\Platform\Addon\Extension\Event\ExtensionWasEnabled;
use Anomaly\Streams\Platform\Addon\Extension\Extension;

/**
 * Class EnableExtension
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class EnableExtension
{

    /**
     * The extension to uninstall.
     *
     * @var Extension
     */
    protected $extension;

    /**
     * Create a new EnableExtension instance.
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
        $extensions->enabled($this->extension);

        event(new ExtensionWasEnabled($this->extension));

        return true;
    }
}
