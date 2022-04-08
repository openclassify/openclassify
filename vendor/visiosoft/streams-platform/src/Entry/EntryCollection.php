<?php namespace Anomaly\Streams\Platform\Entry;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Model\EloquentCollection;
use Anomaly\Streams\Platform\Support\Decorator;

/**
 * Class EntryCollection
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class EntryCollection extends EloquentCollection
{

    /**
     * Return the sorted entries.
     *
     * @param  bool|false $reverse
     * @return static
     */
    public function sorted($direction = 'asc')
    {
        $items = [];

        /* @var EntryInterface $item */
        foreach ($this->items as $item) {
            $items[$item->getSortOrder()] = $item;
        }

        ksort($items);

        if (strtolower($direction) == 'desc') {
            $items = array_reverse($items);
        }

        return self::make($items);
    }

    /**
     * Return labels for each entry.
     *
     * @param  null   $text
     * @param  string $context
     * @param  string $size
     * @return array
     */
    public function labels($text = null, $context = null, $size = null)
    {
        $decorator = new Decorator();

        return array_map(
            function ($entry) use ($decorator, $text, $context, $size) {

                /* @var EntryPresenter $entry */
                if (!$entry instanceof EntryPresenter) {
                    $entry = $decorator->decorate($entry);
                }

                return $entry->label($text, $context, $size);
            },
            $this->all()
        );
    }
}
