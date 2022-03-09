<?php namespace Anomaly\PagesModule\Type\Contract;

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
     * Find a type by it's slug.
     *
     * @param $slug
     * @return TypeInterface
     */
    public function findBySlug($slug);
}
