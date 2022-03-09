<?php namespace Anomaly\Streams\Platform\Addon\Event;

use Anomaly\Streams\Platform\Addon\AddonCollection;

/**
 * Class AddonsHaveRegistered
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class AddonsHaveRegistered
{

    /**
     * The addon collection.
     *
     * @var AddonCollection
     */
    protected $addons;

    /**
     * Create a new AddonsHaveRegistered instance.
     *
     * @param AddonCollection $addons
     */
    public function __construct(AddonCollection $addons)
    {
        $this->addons = $addons;
    }

    /**
     * Get the addon collection.
     *
     * @return AddonCollection
     */
    public function getAddons()
    {
        return $this->addons;
    }
}
