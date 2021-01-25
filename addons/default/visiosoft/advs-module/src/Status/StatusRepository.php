<?php namespace Visiosoft\AdvsModule\Status;

use Visiosoft\AdvsModule\Status\Contract\StatusRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class StatusRepository extends EntryRepository implements StatusRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var StatusModel
     */
    protected $model;

    /**
     * Create a new StatusRepository instance.
     *
     * @param StatusModel $model
     */
    public function __construct(StatusModel $model)
    {
        $this->model = $model;
    }
}
