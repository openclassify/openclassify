<?php namespace Anomaly\Streams\Platform\Addon\Module\Command;

/**
 * Class InstallAllModules
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class InstallAllModules
{

    /**
     * The seed flag.
     *
     * @var bool
     */
    protected $seed;

    /**
     * Create a new InstallAllModules instance.
     *
     * @param bool $seed
     */
    public function __construct($seed = false)
    {
        $this->seed = $seed;
    }

    /**
     * Get the seed flag.
     *
     * @return bool
     */
    public function getSeed()
    {
        return $this->seed;
    }
}
