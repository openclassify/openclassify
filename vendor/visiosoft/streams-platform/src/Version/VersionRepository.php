<?php namespace Anomaly\Streams\Platform\Version;

use Anomaly\Streams\Platform\Model\EloquentRepository;
use Anomaly\Streams\Platform\Version\Contract\VersionRepositoryInterface;

/**
 * Class VersionRepository
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class VersionRepository extends EloquentRepository implements VersionRepositoryInterface
{

    /**
     * The version model.
     *
     * @var VersionModel
     */
    protected $model;

    /**
     * Create a new VersionRepository instance.
     *
     * @param VersionModel $model
     */
    public function __construct(VersionModel $model)
    {
        $this->model = $model;
    }

    /**
     * Delete all version history for a model.
     *
     * @param $name
     * @return $this
     */
    public function deleteVersionHistory($name)
    {
        $this->model->where('versionable_type', $name)->delete();

        return $this;
    }

}
