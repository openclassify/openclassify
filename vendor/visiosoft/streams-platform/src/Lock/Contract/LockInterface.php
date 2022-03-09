<?php namespace Anomaly\Streams\Platform\Lock\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Interface LockInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface LockInterface
{

    /**
     * Touch the locked at time.
     *
     * @return bool
     */
    public function touch();

    /**
     * Return the locked by username.
     *
     * @return string
     */
    public function lockedByUsername();

    /**
     * Get the related locked by user.
     *
     * @return EntryInterface
     */
    public function getLockedBy();

    /**
     * Return the locked by relation.
     *
     * @return BelongsTo
     */
    public function lockedBy();

}
