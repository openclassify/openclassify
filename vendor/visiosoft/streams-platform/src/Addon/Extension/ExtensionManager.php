<?php namespace Anomaly\Streams\Platform\Addon\Extension;

use Anomaly\Streams\Platform\Addon\Extension\Command\DisableExtension;
use Anomaly\Streams\Platform\Addon\Extension\Command\EnableExtension;
use Anomaly\Streams\Platform\Addon\Extension\Command\InstallExtension;
use Anomaly\Streams\Platform\Addon\Extension\Command\MigrateExtension;
use Anomaly\Streams\Platform\Addon\Extension\Command\UninstallExtension;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class ExtensionManager
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class ExtensionManager
{
    use DispatchesJobs;

    /**
     * Install a module.
     *
     * @param  Extension $module
     * @param  bool      $seed
     * @return bool
     */
    public function install(Extension $module, $seed = false)
    {
        return $this->dispatchNow(new InstallExtension($module, $seed));
    }

    /**
     * Migrate a module.
     *
     * @param  Extension $module
     * @param  bool      $seed
     * @return bool
     */
    public function migrate(Extension $module, $seed = false)
    {
        return $this->dispatchNow(new MigrateExtension($module, $seed));
    }

    /**
     * Uninstall a module.
     *
     * @param  Extension $module
     * @return bool
     */
    public function uninstall(Extension $module)
    {
        return $this->dispatchNow(new UninstallExtension($module));
    }

    /**
     * Enable a extension.
     *
     * @param Extension $extension
     * @param bool   $seed
     */
    public function enable(Extension $extension)
    {
        $this->dispatchNow(new EnableExtension($extension));
    }

    /**
     * Disable a extension.
     *
     * @param Extension $extension
     */
    public function disable(Extension $extension)
    {
        $this->dispatchNow(new DisableExtension($extension));
    }

}
