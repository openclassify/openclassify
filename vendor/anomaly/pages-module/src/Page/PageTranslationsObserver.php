<?php namespace Anomaly\PagesModule\Page;

use Anomaly\PagesModule\Page\Command\SetPath;
use Anomaly\PagesModule\Page\Command\UpdatePaths;
use Anomaly\Streams\Platform\Entry\EntryTranslationsModel;
use Anomaly\Streams\Platform\Entry\EntryTranslationsObserver;

/**
 * Class PageTranslationsObserver
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PageTranslationsObserver extends EntryTranslationsObserver
{

    /**
     * Fired just before saving the entry.
     *
     * @param EntryTranslationsModel|PageTranslationsModel $entry
     */
    public function saving(EntryTranslationsModel $entry)
    {
        $this->dispatch(new SetPath($entry));

        parent::saving($entry);
    }

    /**
     * Fired after saving the page.
     *
     * @param EntryTranslationsModel|PageTranslationsModel $entry
     */
    public function saved(EntryTranslationsModel $entry)
    {
        $this->dispatch(new UpdatePaths($entry));

        parent::saved($entry);
    }
}
