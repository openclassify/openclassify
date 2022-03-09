<?php namespace Anomaly\Streams\Platform\Addon\Extension\Contract;

use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Model\Contract\EloquentRepositoryInterface;

/**
 * Interface ExtensionRepositoryInterface
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
interface ExtensionRepositoryInterface extends EloquentRepositoryInterface
{

    /**
     * Mark a extension as installed.
     *
     * @param  Extension $extension
     * @return bool
     */
    public function install(Extension $extension);

    /**
     * Mark a extension as uninstalled.
     *
     * @param  Extension $extension
     * @return bool
     */
    public function uninstall(Extension $extension);

    /**
     * Mark a extension as disabled.
     *
     * @param  Extension $extension
     * @return bool
     */
    public function disable(Extension $extension);

    /**
     * Mark a extension as enabled.
     *
     * @param  Extension $extension
     * @return bool
     */
    public function enabled(Extension $extension);
}
