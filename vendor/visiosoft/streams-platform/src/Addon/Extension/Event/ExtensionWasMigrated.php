<?php namespace Anomaly\Streams\Platform\Addon\Extension\Event;

use Anomaly\Streams\Platform\Addon\Extension\Extension;

/**
 * Class ExtensionWasInstalled
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class ExtensionWasMigrated
{

    /**
     * The extension object.
     *
     * @var \Anomaly\Streams\Platform\Addon\Extension\Extension
     */
    protected $extension;

    /**
     * Create a new ExtensionWasInstalled instance.
     *
     * @param Extension $extension
     */
    public function __construct(Extension $extension)
    {
        $this->extension = $extension;
    }

    /**
     * Get the extension object.
     *
     * @return Extension
     */
    public function getExtension()
    {
        return $this->extension;
    }
}
