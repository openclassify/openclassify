<?php namespace Visiosoft\NotificationsModule\Notify;

use Visiosoft\NotificationsModule\Notify\Contract\NotifyRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class NotifyRepository extends EntryRepository implements NotifyRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var NotifyModel
     */
    protected $model;

    /**
     * Create a new NotifyRepository instance.
     *
     * @param NotifyModel $model
     */
    public function __construct(NotifyModel $model)
    {
        $this->model = $model;
    }
}
