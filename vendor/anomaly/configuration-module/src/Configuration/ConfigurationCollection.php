<?php namespace Anomaly\ConfigurationModule\Configuration;

use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;

/**
 * Class ConfigurationCollection
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ConfigurationCollection extends EntryCollection
{

    /**
     * Create a new ConfigurationCollection instance.
     *
     * @param array $items
     */
    public function __construct($items = [])
    {
        /* @var ConfigurationInterface $item */
        foreach ($items as $item) {
            $this->items[$item->getKey() . $item->getScope()] = $item;
        }
    }
}
