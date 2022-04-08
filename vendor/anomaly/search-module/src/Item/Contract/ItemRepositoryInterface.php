<?php namespace Anomaly\SearchModule\Item\Contract;

use Anomaly\SearchModule\Item\ItemCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Illuminate\Database\Eloquent\Collection;
use Laravel\Scout\Builder;

/**
 * Interface ItemRepositoryInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface ItemRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Find all items by entry.
     *
     * @param EntryModel $entry
     * @return ItemInterface|null
     */
    public function findAllByEntry(EntryModel $entry);
    
    /**
     * Find an item by entry and locale.
     *
     * @param EntryModel $entry
     * @param $locale
     * @return ItemInterface|null
     */
    public function findByEntryAndLocale(EntryModel $entry, $locale);

    /**
     * Return simple search results.
     *
     * @param Builder $builder
     * @param array $options
     * @return ItemCollection|Collection
     * @internal param $stream
     * @internal param $query
     */
    public function search(Builder $builder, array $options = []);
}
