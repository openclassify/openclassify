<?php namespace Anomaly\PostsModule\Type;

use Anomaly\PostsModule\Type\Command\CreateTypeStream;
use Anomaly\PostsModule\Type\Command\DeleteTypeStream;
use Anomaly\PostsModule\Type\Command\UpdatePosts;
use Anomaly\PostsModule\Type\Command\UpdateStream;
use Anomaly\PostsModule\Type\Contract\TypeInterface;
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
        $this->commands->dispatch(new CreateTypeStream($entry));

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
        $this->commands->dispatch(new UpdatePosts($entry));

        parent::updating($entry);
    }

    /**
     * Fired after a page type is deleted.
     *
     * @param EntryInterface|TypeInterface $entry
     */
    public function deleted(EntryInterface $entry)
    {
        $this->commands->dispatch(new DeleteTypeStream($entry));

        parent::deleted($entry);
    }
}
