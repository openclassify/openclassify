<?php namespace Anomaly\Streams\Platform\Version\Contract;

use Anomaly\Streams\Platform\Model\Contract\EloquentRepositoryInterface;

/**
 * Interface VersionRepositoryInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface VersionRepositoryInterface extends EloquentRepositoryInterface
{

    /**
     * Delete all version history for a model.
     *
     * @param $name
     * @return $this
     */
    public function deleteVersionHistory($name);
}
