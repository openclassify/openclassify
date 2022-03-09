<?php namespace Anomaly\UsersModule\User\Security\Contract;

use Anomaly\UsersModule\User\Contract\UserInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface SecurityCheckInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface SecurityCheckInterface
{

    /**
     * Check a login attempt.
     *
     * @return bool|Response
     */
    public function attempt();

    /**
     * Check an HTTP request.
     *
     * @param  UserInterface $user
     * @return bool|Response
     */
    public function check(UserInterface $user = null);
}
