<?php namespace Anomaly\PreferencesModule\Preference;

use Anomaly\PreferencesModule\Preference\Contract\PreferenceInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;

/**
 * Class PreferenceCollection
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PreferenceCollection extends EntryCollection
{

    /**
     * Create a new PreferenceCollection instance.
     *
     * @param array $items
     */
    public function __construct($items = [])
    {
        /* @var PreferenceInterface $item */
        foreach ($items as $item) {
            $this->items[$item->getKey()] = $item;
        }
    }
}
