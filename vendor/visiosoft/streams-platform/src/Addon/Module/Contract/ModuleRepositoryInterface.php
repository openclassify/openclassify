<?php namespace Anomaly\Streams\Platform\Addon\Module\Contract;

use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Addon\Module\ModuleModel;
use Anomaly\Streams\Platform\Model\Contract\EloquentRepositoryInterface;
use Anomaly\Streams\Platform\Model\EloquentCollection;

/**
 * Interface ModuleRepositoryInterface
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
interface ModuleRepositoryInterface extends EloquentRepositoryInterface
{

    /**
     * Mark a module as installed.
     *
     * @param  Module $module
     * @return bool
     */
    public function install(Module $module);

    /**
     * Mark a module as uninstalled.
     *
     * @param  Module $module
     * @return bool
     */
    public function uninstall(Module $module);

    /**
     * Mark a module as disabled.
     *
     * @param  Module $module
     * @return bool
     */
    public function disable(Module $module);

    /**
     * Mark a module as enabled.
     *
     * @param  Module $module
     * @return bool
     */
    public function enabled(Module $module);
}
