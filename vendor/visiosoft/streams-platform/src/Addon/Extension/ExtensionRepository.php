<?php namespace Anomaly\Streams\Platform\Addon\Extension;

use Anomaly\Streams\Platform\Addon\Extension\Contract\ExtensionRepositoryInterface;
use Anomaly\Streams\Platform\Model\EloquentRepository;

/**
 * Class ExtensionRepository
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ExtensionRepository extends EloquentRepository implements ExtensionRepositoryInterface
{

    /**
     * The extension model.
     *
     * @var ExtensionModel
     */
    protected $model;

    /**
     * Create a new ExtensionRepository instance.
     *
     * @param ExtensionModel $model
     */
    public function __construct(ExtensionModel $model)
    {
        $this->model = $model;
    }

    /**
     * Mark a extension as installed.
     *
     * @param  Extension $extension
     * @return bool
     */
    public function install(Extension $extension)
    {
        if (!$extension = $this->model->findByNamespaceOrNew($extension->getNamespace())) {
            return false;
        }

        $extension->installed = true;
        $extension->enabled   = true;

        $this->model->flushCache();

        return $extension->save();
    }

    /**
     * Mark a extension as uninstalled.
     *
     * @param  Extension $extension
     * @return bool
     */
    public function uninstall(Extension $extension)
    {
        $extension = $this->model->findByNamespace($extension->getNamespace());

        $extension->installed = false;
        $extension->enabled   = false;

        $this->model->flushCache();

        return $extension->save();
    }

    /**
     * Mark a extension as disabled.
     *
     * @param  Extension $extension
     * @return bool
     */
    public function disable(Extension $extension)
    {
        $extension = $this->model->findByNamespace($extension->getNamespace());

        $extension->enabled = false;

        cache()->clear();

        return $extension->save();
    }

    /**
     * Mark a extension as enabled.
     *
     * @param  Extension $extension
     * @return bool
     */
    public function enabled(Extension $extension)
    {
        $extension = $this->model->findByNamespace($extension->getNamespace());

        $extension->enabled = true;

        cache()->clear();

        return $extension->save();
    }
}
