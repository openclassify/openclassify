<?php namespace Anomaly\Streams\Platform\Ui\Grid;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Support\Authorizer;

/**
 * Class GridAuthorizer
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GridAuthorizer
{

    /**
     * The module collection.
     *
     * @var ModuleCollection
     */
    protected $modules;

    /**
     * The authorizer utility.
     *
     * @var Authorizer
     */
    protected $authorizer;

    /**
     * Create a new GridAuthorizer instance.
     *
     * @param ModuleCollection $modules
     * @param Authorizer       $authorizer
     */
    public function __construct(ModuleCollection $modules, Authorizer $authorizer)
    {
        $this->modules    = $modules;
        $this->authorizer = $authorizer;
    }

    /**
     * Authorize the grid.
     *
     * @param GridBuilder $builder
     */
    public function authorize(GridBuilder $builder)
    {
        // Try the option first.
        $permission = $builder->getGridOption('permission');

        /*
         * If the option is not set then
         * try and automate the permission.
         */
        if (!$permission && ($module = $this->modules->active()) && ($stream = $builder->getGridStream())) {
            $permission = $module->getNamespace($stream->getSlug() . '.read');
        }

        if (!$this->authorizer->authorize($permission)) {
            abort(403);
        }
    }
}
