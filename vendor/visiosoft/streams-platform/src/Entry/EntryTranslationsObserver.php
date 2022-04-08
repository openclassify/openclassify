<?php namespace Anomaly\Streams\Platform\Entry;

use Anomaly\Streams\Platform\Entry\Command\SetMetaInformation;
use Anomaly\Streams\Platform\Support\Observer;

/**
 * Class EntryTranslationsObserver
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class EntryTranslationsObserver extends Observer
{

    /**
     * Fired just after a record is created.
     *
     * @param EntryTranslationsModel $entry
     */
    public function created(EntryTranslationsModel $entry)
    {
        $entry->flushCache();
        $entry->flushParentCache();

        $entry->fireFieldTypeEvents('entry_translation_created');
    }

    /**
     * Fired just before a record saves.
     *
     * @param EntryTranslationsModel $entry
     */
    public function saving(EntryTranslationsModel $entry)
    {
        $this->commands->dispatch(new SetMetaInformation($entry));
    }

    /**
     * Fired just after a record is saved.
     *
     * @param EntryTranslationsModel $entry
     */
    public function saved(EntryTranslationsModel $entry)
    {
        $entry->flushCache();
        $entry->flushParentCache();

        $entry->fireFieldTypeEvents('entry_translation_saved');
    }

    /**
     * Fired just after a record is updated.
     *
     * @param EntryTranslationsModel $entry
     */
    public function updated(EntryTranslationsModel $entry)
    {
        $entry->fireFieldTypeEvents('entry_translation_updated');
    }

    /**
     * Fired just after a record is deleted.
     *
     * @param EntryTranslationsModel $entry
     */
    public function deleted(EntryTranslationsModel $entry)
    {
        $entry->flushCache();
        $entry->flushParentCache();

        $entry->fireFieldTypeEvents('entry_translation_deleted');
    }
}
