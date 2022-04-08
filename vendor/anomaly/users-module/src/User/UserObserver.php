<?php namespace Anomaly\UsersModule\User;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;
use Anomaly\UsersModule\User\Command\SetStrId;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Event\UserWasCreated;
use Anomaly\UsersModule\User\Event\UserWasDeleted;
use Anomaly\UsersModule\User\Event\UserWasUpdated;

/**
 * Class UserObserver
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class UserObserver extends EntryObserver
{

    /**
     * Fired just before a user is created.
     *
     * @param EntryInterface|UserInterface $entry
     */
    public function creating(EntryInterface $entry)
    {
        $this->dispatchNow(new SetStrId($entry));

        parent::creating($entry);
    }


    /**
     * Fired after a user is created.
     *
     * @param EntryInterface|UserInterface $entry
     */
    public function created(EntryInterface $entry)
    {
        event(new UserWasCreated($entry));

        parent::created($entry);
    }

    /**
     * Fired after a user is updated.
     *
     * @param EntryInterface|UserInterface $entry
     */
    public function updated(EntryInterface $entry)
    {
        event(new UserWasUpdated($entry));

        parent::updated($entry);
    }

    /**
     * Fired after a user is deleted.
     *
     * @param EntryInterface|UserInterface $entry
     */
    public function deleted(EntryInterface $entry)
    {
        if (!$entry->isForceDeleting()) {
            event(new UserWasDeleted($entry));
        }

        parent::deleted($entry);
    }
}
