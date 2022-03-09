<?php namespace Anomaly\Streams\Platform\Addon\Module\Command;

use Anomaly\Streams\Platform\Addon\Module\Contract\ModuleRepositoryInterface;
use Anomaly\Streams\Platform\Addon\Module\Event\ModuleWasEnabled;
use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class EnableModule
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class EnableModule
{

    /**
     * The module to uninstall.
     *
     * @var Module
     */
    protected $module;

    /**
     * Create a new EnableModule instance.
     *
     * @param Module $module
     */
    public function __construct(Module $module)
    {
        $this->module = $module;
    }

    /**
     * Handle the command.
     *
     * @param  ModuleRepositoryInterface $modules
     * @return bool
     */
    public function handle(ModuleRepositoryInterface $modules)
    {
        $modules->enabled($this->module);

        event(new ModuleWasEnabled($this->module));

        return true;
    }
}
