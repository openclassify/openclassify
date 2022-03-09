<?php namespace Visiosoft\ConnectModule\Listeners;

use Visiosoft\ConnectModule\Events\ActivateAccount;
use Visiosoft\ConnectModule\Notification\ActivateYourAccount;
use Visiosoft\ProjectsModule\Project\Contract\ProjectRepositoryInterface;
use Visiosoft\UserProfileExtension\Events\ClosedAccount;

class SendActivationMail
{
    protected $repository;

    public function __construct(ProjectRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(ActivateAccount $event)
    {
        $user = $event->getUser();

        $user->notify(new ActivateYourAccount($event->getURL()));

    }
}
