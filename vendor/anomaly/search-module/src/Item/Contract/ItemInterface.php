<?php namespace Anomaly\SearchModule\Item\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryModel;

/**
 * Interface ItemInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface ItemInterface extends EntryInterface
{

    /**
     * Get the related entry.
     *
     * @return EntryModel
     */
    public function getEntry();
}
