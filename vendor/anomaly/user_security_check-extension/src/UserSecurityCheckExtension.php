<?php namespace Anomaly\UserSecurityCheckExtension;

use Anomaly\UserSecurityCheckExtension\Command\CheckUser;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Security\SecurityCheckExtension;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserSecurityCheckExtension
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class UserSecurityCheckExtension extends SecurityCheckExtension
{

    /**
     * This extension provides a security check that
     * assures the user is active, enabled, etc.
     *
     * @var null|string
     */
    protected $provides = 'anomaly.module.users::security_check.user';

    /**
     * Check an HTTP request.
     *
     * @param  UserInterface $user
     * @return bool|Response
     */
    public function check(UserInterface $user = null)
    {
        if (!$user) {
            return true;
        }

        return $this->dispatch(new CheckUser($user));
    }

}
