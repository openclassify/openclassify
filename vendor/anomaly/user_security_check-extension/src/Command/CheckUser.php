<?php namespace Anomaly\UserSecurityCheckExtension\Command;

use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\UserAuthenticator;
use Illuminate\Routing\Redirector;

/**
 * Class CheckUser
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class CheckUser
{

    /**
     * The user instance.
     *
     * @var UserInterface
     */
    protected $user;

    /**
     * Create a new CheckUser instance.
     *
     * @param UserInterface $user
     */
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * @param  UserAuthenticator                      $authenticator
     * @param  MessageBag                             $message
     * @param  Redirector                             $redirect
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    public function handle(UserAuthenticator $authenticator, MessageBag $message, Redirector $redirect)
    {
        if (!$this->user->isActivated()) {

            $message->error('anomaly.extension.user_security_check::message.account_is_not_activated');

            $authenticator->logout(); // Just in case.

            return $redirect->back();
        }

        if (!$this->user->isEnabled()) {

            $message->error('anomaly.extension.user_security_check::message.account_is_disabled');

            $authenticator->logout(); // Just in case.

            return $redirect->back();
        }

        return true;
    }
}
