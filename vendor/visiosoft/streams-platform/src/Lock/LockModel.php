<?php namespace Anomaly\Streams\Platform\Lock;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Lock\Contract\LockInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class LockModel
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class LockModel extends EloquentModel implements LockInterface
{

    /**
     * The eager loaded relation.
     *
     * @var array
     */
    protected $with = [
        'lockedBy',
    ];

    /**
     * The timestamps flag.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The model table.
     *
     * @var string
     */
    protected $table = 'streams_locks';

    /**
     * Touch the locked at time.
     *
     * @return bool
     */
    public function touch()
    {
        $this->locked_at = new Carbon();

        return $this->save();
    }

    /**
     * Return the locked by username.
     *
     * @return string
     */
    public function lockedByUsername()
    {
        $user = $this->getLockedBy();

        return $user->getAttribute('username');
    }

    /**
     * Get the related locked by user.
     *
     * @return EntryInterface
     */
    public function getLockedBy()
    {
        return $this->lockedBy;
    }

    /**
     * Return the locked by relation.
     *
     * @return BelongsTo
     */
    public function lockedBy()
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

}
