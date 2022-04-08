<?php namespace Anomaly\Streams\Platform\Field\Contract;

use Anomaly\Streams\Platform\Field\FieldCollection;
use Anomaly\Streams\Platform\Model\Contract\EloquentRepositoryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;

/**
 * Interface FieldRepositoryInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface FieldRepositoryInterface extends EloquentRepositoryInterface
{

    /**
     * Find a field by it's slug and namespace.
     *
     * @param  $slug
     * @param  $namespace
     * @return null|FieldInterface|EloquentModel
     */
    public function findBySlugAndNamespace($slug, $namespace);

    /**
     * Return all fields in a namespace.
     *
     * @param  $namespace
     * @return FieldCollection
     */
    public function findAllByNamespace($namespace);

    /**
     * Clean up abandoned fields.
     */
    public function cleanup();
}
