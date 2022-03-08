<?php namespace Visiosoft\NotificationsModule\Notify;

use Anomaly\UsersModule\User\UserModel;
use Visiosoft\AdvsModule\Adv\AdvModel;
use Visiosoft\NotificationsModule\Notify\Contract\NotifyInterface;
use Anomaly\Streams\Platform\Model\Notifications\NotificationsNotifyEntryModel;

class NotifyModel extends NotificationsNotifyEntryModel implements NotifyInterface
{
    public function getUser($id)
    {
        return UserModel::query()->find($id);
    }

    public function getAd($id)
    {
        return AdvModel::query()
            ->find($id);
    }

    public function addNotifyLog($subdomain, $remaining_days)
    {
        $this->create(['subdomain' => $subdomain, 'remaining_days' => $remaining_days]);
    }

    public function getLog($column, $value)
    {
        return $this->where($column,$value)->first();
    }

}
