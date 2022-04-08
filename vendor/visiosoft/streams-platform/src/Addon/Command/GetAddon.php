<?php namespace Anomaly\Streams\Platform\Addon\Command;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\AddonCollection;

class GetAddon
{

    /**
     * The addon identifier.
     *
     * @var string
     */
    protected $identifier;

    /**
     * Create a new GetAddon instance.
     *
     * @param string $identifier The addon namespace / slug
     */
    public function __construct($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * Handle the command.
     *
     * @param AddonCollection $addons
     *
     * @return Addon
     */
    public function handle(AddonCollection $addons)
    {
        return $addons->get($this->identifier);
    }
}
