<?php namespace Anomaly\Streams\Platform\Entry\Contract;

use Anomaly\Streams\Platform\Entry\EntryCollection;
use Anomaly\Streams\Platform\Model\Contract\EloquentRepositoryInterface;

/**
 * Interface EntryRepositoryInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface EntryRepositoryInterface extends EloquentRepositoryInterface
{

    /**
     * Get the entries by sort order.
     *
     * @param  string                 $direction
     * @return EntryCollection
     */
    public function sorted($direction = 'asc');

    /**
     * Get the first entry
     * by it's sort order.
     *
     * @param  string              $direction
     * @return EntryInterface|null
     */
    public function first($direction = 'asc');

    /**
     * Return the last modified entry.
     *
     * @return EntryInterface|null
     */
    public function lastModified();
}
