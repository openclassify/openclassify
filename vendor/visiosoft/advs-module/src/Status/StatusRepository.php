<?php namespace Visiosoft\AdvsModule\Status;

use Visiosoft\AdvsModule\Status\Contract\StatusRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class StatusRepository extends EntryRepository implements StatusRepositoryInterface
{
    protected $model;

    public function __construct(StatusModel $model)
    {
        $this->model = $model;
    }

    public function getUserAccessibleStatuses()
    {
        return $this->newQuery()->where(['is_system' => 0, 'user_access' => 1])->get();
    }
}
