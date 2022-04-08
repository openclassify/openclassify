<?php namespace Anomaly\SettingsModule\Setting;

use Anomaly\SettingsModule\Setting\Command\DumpSettings;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

/**
 * Class SettingObserver
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SettingObserver extends EntryObserver
{

    /**
     * Fired just after an entry is saved.
     *
     * @param EntryInterface $entry
     */
    public function saved(EntryInterface $entry)
    {
        parent::saved($entry);

        dispatch_now(new DumpSettings());
    }
}
