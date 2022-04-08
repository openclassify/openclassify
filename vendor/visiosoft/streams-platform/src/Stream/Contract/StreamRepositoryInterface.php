<?php namespace Anomaly\Streams\Platform\Stream\Contract;

use Anomaly\Streams\Platform\Model\Contract\EloquentRepositoryInterface;
use Anomaly\Streams\Platform\Model\EloquentCollection;
use Anomaly\Streams\Platform\Stream\StreamCollection;

/**
 * Interface StreamRepositoryInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface StreamRepositoryInterface extends EloquentRepositoryInterface
{

    /**
     * Find a stream by it's namespace and slug.
     *
     * @param  $slug
     * @param  $namespace
     * @return null|StreamInterface
     */
    public function findBySlugAndNamespace($slug, $namespace);

    /**
     * Find all streams by their searchable flag.
     *
     * @param $searchable
     * @return StreamCollection
     */
    public function findAllBySearchable($searchable);

    /**
     * Find all streams in a namespace.
     *
     * @param  $namespace
     * @return null|EloquentCollection
     */
    public function findAllByNamespace($namespace);

    /**
     * Destroy a namespace.
     *
     * @param $namespace
     */
    public function destroy($namespace);

    /**
     * Return streams that are/not hidden.
     *
     * @param $hidden
     * @return StreamCollection
     */
    public function hidden($hidden = true);

    /**
     * Return only visible streams.
     *
     * @return StreamCollection
     */
    public function visible();

    /**
     * Clean up abandoned streams.
     */
    public function cleanup();
}
