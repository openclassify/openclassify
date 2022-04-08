<?php namespace Anomaly\Streams\Platform\Addon\Module\Event;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class ModuleWasEnabled
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class ModuleWasEnabled
{

    /**
     * The module object.
     *
     * @var Module
     */
    protected $module;

    /**
     * Create a new ModuleWasEnabled instance.
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
