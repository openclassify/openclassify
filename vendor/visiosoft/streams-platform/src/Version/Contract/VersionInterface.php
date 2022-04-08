<?php namespace Anomaly\Streams\Platform\Version\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Interface VersionInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface VersionInterface
{

    /**
     * Get the data.
     *
     * @return array
     */
    public function getData();

    /**
     * Get the model.
     *
     * @return EloquentModel|EntryInterface
     */
    public function getModel();

    /**
     * Get the version.
     *
     * @return int
     */
    public function getVersion();

    /**
     * Get the related versionable.
     *
     * @return EntryInterface|EloquentModel
     */
    public function getVersionable();

    /**
     * Return the versionable relation.
     *
     * @return MorphTo
     */
    public function versionable();

    /**
     * Return the related creator.
     *
     * @return Authenticatable
     */
    public function getCreatedBy();

    /**
     * Return the creator relation.
     *
     * @return BelongsTo
     */
    public function createdBy();

}
