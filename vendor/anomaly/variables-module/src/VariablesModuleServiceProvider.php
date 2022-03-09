<?php namespace Anomaly\VariablesModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Assignment\AssignmentRouter;
use Anomaly\Streams\Platform\Field\FieldRouter;
use Anomaly\Streams\Platform\Version\VersionRouter;
use Anomaly\VariablesModule\Http\Controller\Admin\AssignmentsController;
use Anomaly\VariablesModule\Http\Controller\Admin\FieldsController;
use Anomaly\VariablesModule\Http\Controller\Admin\VersionsController;
use Anomaly\VariablesModule\Variable\Contract\VariableRepositoryInterface;
use Anomaly\VariablesModule\Variable\VariableRepository;

/**
 * Class VariablesModuleServiceProvider
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class VariablesModuleServiceProvider extends AddonServiceProvider
{

    /**
     * Plugins provided by the addon.
     *
     * @var array
     */
    protected $plugins = [
        VariablesModulePlugin::class,
    ];

    /**
     * The singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        VariableRepositoryInterface::class => VariableRepository::class,
    ];

    /**
     * Map the addon.
     *
     * @param FieldRouter $fields
     * @param VersionRouter $versions
     * @param AssignmentRouter $assignments
     */
    public function map(FieldRouter $fields, VersionRouter $versions, AssignmentRouter $assignments)
    {
        $fields->route($this->addon, FieldsController::class);
        $versions->route($this->addon, VersionsController::class);
        $assignments->route($this->addon, AssignmentsController::class, 'admin/variables/groups');
    }
}
