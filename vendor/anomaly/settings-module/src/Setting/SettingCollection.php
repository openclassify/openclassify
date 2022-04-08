<?php namespace Anomaly\SettingsModule\Setting;

use Anomaly\SettingsModule\Setting\Contract\SettingInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;

/**
 * Class SettingCollection
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SettingCollection extends EntryCollection
{

    /**
     * Create a new SettingCollection instance.
     *
     * @param array $items
     */
    public function __construct($items = [])
    {
        /* @var SettingInterface $item */
        foreach ($items as $item) {
            $this->items[$item->getKey()] = $item;
        }
    }
}
