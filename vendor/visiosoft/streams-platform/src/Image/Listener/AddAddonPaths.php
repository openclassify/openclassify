<?php namespace Anomaly\Streams\Platform\Image\Listener;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\Event\AddonsHaveRegistered;
use Anomaly\Streams\Platform\Image\ImagePaths;

/**
 * Class AddAddonPaths
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddAddonPaths
{

    /**
     * The image paths.
     *
     * @var ImagePaths
     */
    protected $paths;

    /**
     * Create a new AddAddonPaths instance.
     *
     * @param ImagePaths $paths
     */
    public function __construct(ImagePaths $paths)
    {
        $this->paths = $paths;
    }

    /**
     * Handle the event.
     *
     * @param AddonsHaveRegistered $event
     */
    public function handle(AddonsHaveRegistered $event)
    {
        $addons = $event->getAddons();

        /* @var Addon $addon */
        foreach ($addons as $addon) {
            $this->paths->addPath($addon->getNamespace(), $addon->getPath('resources'));
        }
    }
}
