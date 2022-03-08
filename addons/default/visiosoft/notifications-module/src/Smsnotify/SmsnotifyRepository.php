<?php namespace Visiosoft\NotificationsModule\Smsnotify;

use Visiosoft\NotificationsModule\Smsnotify\Contract\SmsnotifyRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class SmsnotifyRepository extends EntryRepository implements SmsnotifyRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var SmsnotifyModel
     */
    protected $model;

    /**
     * Create a new SmsnotifyRepository instance.
     *
     * @param SmsnotifyModel $model
     */
    public function __construct(SmsnotifyModel $model)
    {
        $this->model = $model;
    }
}
