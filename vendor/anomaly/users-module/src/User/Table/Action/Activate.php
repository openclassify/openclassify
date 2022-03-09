<?php namespace Anomaly\UsersModule\User\Table\Action;

use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\UsersModule\User\Notification\UserHasBeenActivated;
use Anomaly\UsersModule\User\UserActivator;
use Illuminate\Notifications\Notifiable;

/**
 * Class Activate
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Activate extends ActionHandler
{

    /**
     * Delete the selected entries.
     *
     * @param UserRepositoryInterface $users
     * @param UserActivator           $activator
     * @param array                   $selected
     */
    public function handle(UserRepositoryInterface $users, UserActivator $activator, array $selected)
    {
        $count = 0;

        /* @var UserInterface|Notifiable $user */
        foreach ($selected as $id) {

            $user = $users->find($id);

            if ($user && $activator->force($user)) {

                $count++;

                $user->notify(new UserHasBeenActivated());
            }
        }

        if ($selected && $count > 0) {
            $this->messages->success(trans('anomaly.module.users::message.activate_success', compact('count')));
        }

        if ($selected && $count === 0) {
            $this->messages->warning(trans('anomaly.module.users::message.activate_success', compact('count')));
        }
    }
}
