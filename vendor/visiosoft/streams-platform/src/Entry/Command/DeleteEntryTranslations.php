<?php namespace Anomaly\Streams\Platform\Entry\Command;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

/**
 * Class DeleteEntryTranslations
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DeleteEntryTranslations
{

    /**
     * The entry instance.
     *
     * @var EntryInterface
     */
    protected $entry;

    /**
     * Create a new DeleteEntryTranslations instance.
     *
     * @param EntryInterface $entry
     */
    public function __construct(EntryInterface $entry)
    {
        $this->entry = $entry;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        if ($this->entry->isTranslatable() && (!$this->entry->isTrashable() || $this->entry->isForceDeleting())) {
            foreach ($this->entry->getTranslations() as $translation) {
                $translation->delete();
            }
        }
    }
}
