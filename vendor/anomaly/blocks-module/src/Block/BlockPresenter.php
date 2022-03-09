<?php namespace Anomaly\BlocksModule\Block;

use Anomaly\BlocksModule\Block\Contract\BlockInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Anomaly\Streams\Platform\Support\Decorator;

/**
 * Class BlockPresenter
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BlockPresenter extends EntryPresenter
{

    /**
     * The decorated object.
     *
     * @var BlockInterface
     */
    protected $object;

    /**
     * Catch calls to fields on
     * the page's related entry.
     *
     * @param  string $key
     * @return mixed
     */
    public function __get($key)
    {
        $meta = ['id', 'sort_order', 'created_at', 'created_by', 'updated_at', 'updated_by'];
        
        if (in_array($key, $meta) || $this->object->hasField($key)) {
            return parent::__get($key);
        }

        if ($this->object->hasData($key)) {
            return $this->object->getData()[$key];
        }

        $entry = $this->object->getEntry();

        if ($entry && $entry->hasField($key)) {
            return (New Decorator())->decorate($entry)->{$key};
        }

        return $this->object->configuration($key);
    }
}
