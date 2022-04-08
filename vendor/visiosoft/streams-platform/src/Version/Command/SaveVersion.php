<?php namespace Anomaly\Streams\Platform\Version\Command;

use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Model\Traits\Versionable;
use Anomaly\Streams\Platform\Version\Contract\VersionRepositoryInterface;

/**
 * Class SaveVersion
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SaveVersion
{

    /**
     * The eloquent model.
     *
     * @var EntryModel
     */
    protected $model;

    /**
     * Create a new SaveVersion instance.
     *
     * @param EntryModel|Versionable $model
     */
    public function __construct(EntryModel $model)
    {
        $this->model = $model;
    }

    /**
     * Handle the command.
     *
     * @param VersionRepositoryInterface $versions
     */
    public function handle(VersionRepositoryInterface $versions)
    {
        $versions->create(
            [
                'created_by_id' => auth()->id(),
                'versionable'   => $this->model,
                'ip_address'    => request()->ip(),
                'model'         => serialize($this->model),
                'data'          => serialize($this->model->versionedAttributeChanges()),
            ]
        );
    }

}
