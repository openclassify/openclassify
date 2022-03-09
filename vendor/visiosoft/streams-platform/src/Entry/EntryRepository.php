<?php namespace Anomaly\Streams\Platform\Entry;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;
use Anomaly\Streams\Platform\Model\EloquentRepository;

/**
 * Class EntryRepository
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class EntryRepository extends EloquentRepository implements EntryRepositoryInterface
{

    /**
     * Get the entries by sort order.
     *
     * @param  string                 $direction
     * @return EntryCollection|static
     */
    public function sorted($direction = 'asc')
    {
        return $this->model->sorted($direction)->get();
    }

    /**
     * Get the first entry
     * by it's sort order.
     *
     * @param  string              $direction
     * @return EntryInterface|null
     */
    public function first($direction = 'asc')
    {
        return $this->model->sorted($direction)->first();
    }

    /**
     * Return the last modified entry.
     *
     * @return EntryInterface|null
     */
    public function lastModified()
    {
        return $this->model
            ->orderBy('updated_at', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->first();
    }
}
