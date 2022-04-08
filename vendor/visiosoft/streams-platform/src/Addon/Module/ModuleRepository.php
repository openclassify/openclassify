<?php namespace Anomaly\Streams\Platform\Addon\Module;

use Anomaly\Streams\Platform\Addon\Module\Contract\ModuleRepositoryInterface;
use Anomaly\Streams\Platform\Model\EloquentRepository;

/**
 * Class ModuleRepository
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ModuleRepository extends EloquentRepository implements ModuleRepositoryInterface
{

    /**
     * The module model.
     *
     * @var ModuleModel
     */
    protected $model;

    /**
     * Create a new ModuleRepository instance.
     *
     * @param ModuleModel $model
     */
    public function __construct(ModuleModel $model)
    {
        $this->model = $model;
    }

    /**
     * Mark a module as installed.
     *
     * @param  Module $module
     * @return bool
     */
    public function install(Module $module)
    {
        if (!$module = $this->model->findByNamespaceOrNew($module->getNamespace())) {
            return false;
        }

        $module->installed = true;
        $module->enabled   = true;

        cache()->clear();

        return $module->save();
    }

    /**
     * Mark a module as uninstalled.
     *
     * @param  Module $module
     * @return bool
     */
    public function uninstall(Module $module)
    {
        if (!$module = $this->model->findByNamespace($module->getNamespace())) {
            return false;
        }

        $module->installed = false;
        $module->enabled   = false;

        cache()->clear();

        return $module->save();
    }

    /**
     * Mark a module as disabled.
     *
     * @param  Module $module
     * @return bool
     */
    public function disable(Module $module)
    {
        $module = $this->model->findByNamespace($module->getNamespace());

        $module->enabled = false;

        cache()->clear();

        return $module->save();
    }

    /**
     * Mark a module as enabled.
     *
     * @param  Module $module
     * @return bool
     */
    public function enabled(Module $module)
    {
        $module = $this->model->findByNamespace($module->getNamespace());

        $module->enabled = true;

        cache()->clear();

        return $module->save();
    }
}
