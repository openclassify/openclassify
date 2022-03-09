<?php namespace Anomaly\SearchModule\Item;

use Anomaly\SearchModule\Item\Contract\ItemInterface;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Model\Search\SearchItemsEntryModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Stream\StreamModel;

/**
 * Class ItemModel
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ItemModel extends SearchItemsEntryModel implements ItemInterface
{

    /**
     * Get the related entry.
     *
     * @return EntryModel
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * Return the related stream.
     *
     * @return StreamInterface|array
     */
    public function stream()
    {
        if (!$this->stream instanceof StreamInterface) {
            $this->stream = app(StreamModel::class)->make($this->stream);
        }

        return $this->stream;
    }
}
