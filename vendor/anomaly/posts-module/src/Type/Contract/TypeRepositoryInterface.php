<?php namespace Anomaly\PostsModule\Type\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface TypeRepositoryInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface TypeRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Find a category by it's slug.
     *
     * @param $slug
     * @return null|TypeInterface
     */
    public function findBySlug($slug);
}
