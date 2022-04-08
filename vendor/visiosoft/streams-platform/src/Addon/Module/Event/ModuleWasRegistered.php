<?php namespace Anomaly\Streams\Platform\Addon\Module\Event;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class ModuleWasRegistered
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ModuleWasRegistered
{

    /**
     * The module object.
     *
     * @var Module
     */
    protected $module;

    /**
     * Create a new ModuleWasRegistered instance.
     *
     * @param Module $module
     */
    public function __construct(Module $module)
    {
        $this->module = $module;
    }

    /**
     * Get the module object.
     *
     * @return Module
     */
    public function getModule()
    {
        return $this->module;
    }
}
