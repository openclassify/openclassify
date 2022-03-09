<?php namespace Anomaly\PagesModule\Type;

use Anomaly\PagesModule\Type\Command\CreateStream;
use Anomaly\PagesModule\Type\Command\DeleteStream;
use Anomaly\PagesModule\Type\Command\UpdatePages;
use Anomaly\PagesModule\Type\Command\UpdateStream;
use Anomaly\PagesModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

/**
 * Class TypeObserver
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class TypeObserver extends EntryObserver
{

    /**
     * Fired after a page type is created.
     *
     * @param EntryInterface|TypeInterface $entry
     */
    public function created(EntryInterface $entry)
    {
        $this->commands->dispatch(new CreateStream($entry));

        parent::created($entry);
    }

    /**
     * Fired before a page type is updated.
     *
     * @param EntryInterface|TypeInterface $entry
     */
    public function updating(EntryInterface $entry)
    {
        $this->commands->dispatch(new UpdateStream($entry));
        $this->commands->dispatch(new UpdatePages($entry));

        parent::updating($entry);
    }

    /**
     * Fired after a page type is deleted.
     *
     * @param EntryInterface|TypeInterface $entry
     */
    public function deleted(EntryInterface $entry)
    {
        $this->commands->dispatch(new DeleteStream($entry));

        parent::deleted($entry);
    }
}
