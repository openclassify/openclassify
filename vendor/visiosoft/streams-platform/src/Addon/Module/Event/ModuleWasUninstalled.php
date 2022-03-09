<?php namespace Anomaly\Streams\Platform\Addon\Module\Event;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class ModuleWasUninstalled
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class ModuleWasUninstalled
{

    /**
     * The module object.
     *
     * @var Module
     */
    protected $module;

    /**
     * Create a new ModuleWasUninstalled instance.
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
