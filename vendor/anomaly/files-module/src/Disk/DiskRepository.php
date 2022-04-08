<?php namespace Anomaly\FilesModule\Disk;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

/**
 * Class DiskRepository
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DiskRepository extends EntryRepository implements DiskRepositoryInterface
{

    /**
     * The disk model.
     *
     * @var DiskModel
     */
    protected $model;

    /**
     * Create a new DiskRepository instance.
     *
     * @param DiskModel $model
     */
    public function __construct(DiskModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find a disk by slug.
     *
     * @param $slug
     * @return null|DiskInterface
     */
    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }
}
