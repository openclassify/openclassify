<?php namespace Anomaly\Streams\Platform\Http\Controller;

use Anomaly\Streams\Platform\Lock\Contract\LockRepositoryInterface;
use Illuminate\Session\Store;

/**
 * Class LocksController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class LocksController extends PublicController
{

    /**
     * Touch the locks for a given URL by session ID.
     *
     * @param LockRepositoryInterface $locks
     * @param Store $session
     */
    public function touch(LockRepositoryInterface $locks)
    {
        if (!auth()->check()) {
            return;
        }

        $locks->touchLocks($this->url->previous());
    }

    /**
     * Release the locks for a given URL by session ID.
     *
     * @param LockRepositoryInterface $locks
     */
    public function release(LockRepositoryInterface $locks)
    {
        $locks->releaseLocks($this->url->previous());
    }

}
