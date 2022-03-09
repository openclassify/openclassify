<?php namespace Anomaly\ThrottleSecurityCheckExtension;

use Anomaly\ThrottleSecurityCheckExtension\Command\ThrottleLogin;
use Anomaly\ThrottleSecurityCheckExtension\Command\ThrottleRequest;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Security\SecurityCheckExtension;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ThrottleSecurityCheckExtension
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ThrottleSecurityCheckExtension extends SecurityCheckExtension
{

    /**
     * This extension provides a security check
     * for users that assures the user is not throttle.
     *
     * @var string
     */
    protected $provides = 'anomaly.module.users::security_check.throttle';

    /**
     * Check a login attempt.
     *
     * @return bool|Response
     */
    public function attempt()
    {
        return $this->dispatch(new ThrottleLogin());
    }

    /**
     * Check an HTTP request.
     *
     * @param  UserInterface $user
     * @return bool|Response
     */
    public function check(UserInterface $user = null)
    {
        return true;
    }


}
