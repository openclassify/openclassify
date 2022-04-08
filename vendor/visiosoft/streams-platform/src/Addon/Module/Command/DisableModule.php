<?php namespace Anomaly\Streams\Platform\Addon\Module\Command;

use Anomaly\Streams\Platform\Addon\Module\Contract\ModuleRepositoryInterface;
use Anomaly\Streams\Platform\Addon\Module\Event\ModuleWasDisabled;
use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class DisableModule
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class DisableModule
{

    /**
     * The module to uninstall.
     *
     * @var Module
     */
    protected $module;

    /**
     * Create a new DisableModule instance.
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
        $modules->disable($this->module);

        event(new ModuleWasDisabled($this->module));

        return true;
    }
}
