<?php namespace Anomaly\Streams\Platform\Ui\Entity;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Support\Authorizer;

/**
 * Class EntityAuthorizer
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity
 */
class EntityAuthorizer
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
     * Create a new EntityAuthorizer instance.
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
     * Authorize the table.
     *
     * @param EntityBuilder $builder
     */
    public function authorize(EntityBuilder $builder)
    {
        // Try the option first.
        $permission = $builder->getEntityOption('permission');

        if ($permission === false) {
            return;
        }

        if (!env('INSTALLED')) {
            return;
        }

        // Use this to help out.
        $module = $this->modules->active();

        // Auto prefix if no module prefix is set.
        if ($permission && strpos($permission, '::') === false && $module) {
            $permission = $module->getNamespace($permission);
        }

        /**
         * If the option is not set then
         * try and automate the permission.
         */
        if (!$permission && $module && ($stream = $builder->getEntityStream())) {

            $entry = $builder->getEntityEntry();

            if ($entry instanceof EntryInterface) {
                $permission = $module->getNamespace($stream->getSlug() . '.write');
            }
        }

        if (!$this->authorizer->authorize($permission)) {
            abort(403);
        }
    }
}
