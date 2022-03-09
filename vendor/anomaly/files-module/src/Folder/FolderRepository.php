<?php namespace Anomaly\FilesModule\Folder;

use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

/**
 * Class FolderRepository
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FolderRepository extends EntryRepository implements FolderRepositoryInterface
{

    /**
     * The folder model.
     *
     * @var FolderModel
     */
    protected $model;

    /**
     * Create a new FolderRepository instance.
     *
     * @param FolderModel $model
     */
    function __construct(FolderModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find a folder by it's slug.
     *
     * @param $slug
     * @return null|FolderInterface
     */
    public function findBySlug($slug)
    {
        return $this->model
            ->withTrashed()
            ->where('slug', $slug)
            ->first();
    }
}
